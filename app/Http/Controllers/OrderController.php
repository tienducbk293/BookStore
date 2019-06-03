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
        return view('page.order');
    }

    public function postOrder(Request $request) {
        $dataOrder = $this->orderData->getDatabase();
        $user_key = session()->get('user_key');
        $cart = session()->get('cart');
        $order = [
            'user_key' => $user_key[0],
            'name' => $request->firstname . " " . $request->lastname,
            'address' => $request->address,
            'phone' => $request->phone,
            'detail' => $cart
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
}
