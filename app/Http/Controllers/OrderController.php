<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $bookData;
    protected $orderData;
    public function __construct(Book $book, Order $order)
    {
        $this->bookData = $book;
        $this->orderData = $order;
    }

    public function order() {
        $carts = session()->get('cart');
        $total = 0;
        foreach ($carts as $key => $cart) {
            $total += $cart['price'] * $cart['quantity'];
        }
        if (strpos($total, ".") !== false) {
            $explode = explode(".", $total);
            if (strlen($explode[1]) == 1) {
                $total_amount = $total."00 đ";
            } elseif(strlen($explode[1]) == 2) {
                $total_amount = $total."0 đ";
            } else {
                $total_amount = $total." đ";
            }
        } else {
            $total_amount = $total.".000 đ";
        }
        return view('page.order', compact('total_amount'));
    }

    public function postOrder(Request $request) {
        $total_amount = $request->total_amount;
        $dataOrder = $this->orderData->getDatabase();
        $user_key = session()->get('user_key');
        $cart = session()->get('cart');
        $order = [
            'user_key' => $user_key,
            'name' => $request->firstname . " " . $request->lastname,
            'address' => $request->address,
            'phone' => $request->phone,
            'detail' => $cart,
            'total_amount' => $total_amount
        ];
        $dataOrder->push($order);
        $this->checkQuantity();
        session()->forget('cart');
        return redirect('/')->with('alert', 'Thanh toán thành công');
    }

    public function checkQuantity() {
        $child = 'book_id';
        foreach (session('cart') as $id => $cart) {
            $id = (string) $id;
            $dataBook = $this->bookData->orderByChild($child, $id);
            $array_key = array_keys($dataBook);
            $key = implode("", $array_key);
            $dataBook[$key]['quantity'] -= $cart['quantity'];
            $this->bookData->getDatabase()->update($dataBook);
        }
        return $data_book = $this->bookData->getAll();
    }

    public function getList() {
        $orders = $this->orderData->getAll();
        return view('admin.order.list', compact('orders'));
    }

    public function delete($key) {
        $this->orderData->getDatabase()->getChild($key)->remove();
        return redirect()->route('order.list')->with(['flash_message', 'Xóa đơn hàng thành công']);
    }
}
