<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CheckoutRepository;
use App\Repositories\BookRepository;

class CheckoutController extends Controller
{
    private $checkoutRepository;
    private $bookRepository;
    public function __construct(CheckoutRepository $checkoutRepository = null, BookRepository $bookRepository = null)
    {
        $this->checkoutRepository = ($checkoutRepository === null) ? new CheckoutRepository() : $checkoutRepository;
        $this->bookRepository = ($bookRepository === null) ? new BookRepository() : $bookRepository;
    }

    public function checkout() {
        return view('page.checkout');
    }

    public function postCheckout(Request $request) {
        $dataCheckout = $this->checkoutRepository->getCheckoutData();
        $user_key = session()->get('user_key');
        $cart = session()->get('cart');
        $checkout = [
            'user_key' => $user_key[0],
            'name' => $request->firstname . " " . $request->lastname,
            'address' => $request->address,
            'phone' => $request->phone,
            'detail' => $cart
        ];
        $dataCheckout->push($checkout);
        $this->checkQuantity();
        session()->forget('cart');
        return redirect('/')->with('alert', 'Thanh toán thành công');
    }

    public function checkQuantity() {
        $data = $this->bookRepository->getBookData();
        foreach (session('cart') as $id => $cart) {
            $id = (string) $id;
            $bookData = $data->orderByChild('book_id')->equalTo($id)->getValue();
            $array_key = array_keys($bookData);
            $key = implode("", $array_key);
            $bookData[$key]['quantity'] -= $cart['quantity'];
            $data->update($bookData);
        }
        return $data_book = $data->getValue();
    }
}
