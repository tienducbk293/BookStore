<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class CartController extends Controller
{
    protected $bookData;
    public function __construct(Book $book)
    {
        $this->bookData = $book;
    }

    public function cart() {
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
        return view('page.cart', compact('total_amount'));
    }

    public function postAdd(Request $request, $id) {
        $child = 'book_id';
        $dataBook = $this->bookData->orderByChild($child, $id);
        $books = array_values($dataBook);
        $book = $books[0];
        $cart = session()->get('cart');
        $bookId = $id;
        // if cart is empty then this the first product
        if (!$cart) {
            $cart[$id]  = [
                    'title' => $book['title'],
                    'image' => $book['image'],
                    'price' => $book['final_price'],
                    'quantity' => $request->quantity
            ];
            $request->session()->put('cart', $cart);
            return redirect()->back()->with('id', $bookId);
        }

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {

            $cart[$id]['quantity'] += $request->quantity;

            session()->put('cart', $cart);
            return redirect()->back()->with('id', $bookId);

        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "title" => $book['title'],
            "image" => $book['image'],
            "price" => $book['final_price'],
            "quantity" => $request->quantity
        ];

        session()->put('cart', $cart);
        return redirect()->back()->with('id', $bookId);
    }

    public function update(Request $request) {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');

            $cart[$request->id]["quantity"] = $request->quantity;

            session()->put('cart', $cart);
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {

            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {

                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }
        }
    }
    
}
