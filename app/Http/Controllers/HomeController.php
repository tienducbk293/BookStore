<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Book;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }


    public function index () {
        $bookData = new Book();
        $data = $bookData->getDatabase();
        $all_book = $data->getValue();
        return view('page.homepage', compact('all_book'));
    }

    public function getDetailBook ($id) {
        $commentData = new Comment();
        $dataComment = $commentData->getDatabase();
        $comments = $dataComment->orderByChild('book_id')->equalTo($id)->getValue();
        $bookData = new Book();
        $data = $bookData->getDatabase();
        $detail_book = $data->orderByChild('book_id')->equalTo($id)->getValue();
        $details = array_values($detail_book);
        $detail = $details[0];
        $all_book = $data->getValue();
        return view('page.detail', compact('detail', 'all_book', 'comments'));
    }
}
