<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CartRepository;
class CartController extends Controller
{
    private $cartRepository;

    public function __construct(CartRepository $cartRepository = null)
    {
        $this->cartRepository = ($cartRepository === null) ? new CartRepository : $cartRepository;
    }

    public function addToCart(Request $request, $id) {
        $data = $this->cartRepository->getBookData();
        $bookData = $data->orderByChild('book_id')->equalTo($id)->getValue();
        $books = array_values($bookData);
        $book = $books[0];
        $cart = $request->session()->get('cart');
        //if cart is empty then this the first book
        if (!$cart) {
            $cart = [
                $id = [
                    "title" => $book['title'],
                    "final_price" => $book['final_price'],
                    "image" => $book['image'],
                    "quantity" => 1
                ]
            ];
            $request->session()->put('cart', $cart);
            return redirect()->back();
        }

        //if cart not empty then check if this book exist then increment quantity
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('id');
        }
    }
    public function removeFromCart(Request $request) {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Xóa sách thành công');

        }
        return redirect()->back();
    }
}
