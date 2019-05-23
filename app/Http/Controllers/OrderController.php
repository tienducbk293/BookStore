<?php

namespace App\Http\Controllers;

use App\Book;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function order() {
        return view('page.order');
    }

    public function postOrder(Request $request) {
        $orderData = new Order();
        $dataOrder = $orderData->getDatabase();
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
        $bookData = new Book();
        $data = $bookData->getDatabase();
        foreach (session('cart') as $id => $cart) {
            $id = (string) $id;
            $dataBook = $data->orderByChild('book_id')->equalTo($id)->getValue();
            $array_key = array_keys($dataBook);
            $key = implode("", $array_key);
            $dataBook[$key]['quantity'] -= $cart['quantity'];
            $data->update($dataBook);
        }
        return $data_book = $data->getValue();
    }
}
