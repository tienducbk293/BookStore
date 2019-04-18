<?php

namespace App\Http\Controllers;

require_once('../vendor/autoload.php');

use App\Repositories\BookRepository;
class HomeController extends Controller
{
    private $bookRepository;

    public function __construct(BookRepository $bookRepository = null)
    {
        $this->bookRepository = ($bookRepository === null) ? new BookRepository : $bookRepository;
    }

    public function index () {
        $data = $this->bookRepository->getBookData();
        $all_book = $data->getValue();
        return view('page.homepage', compact('all_book'));
    }

    public function getDetailBook ($id) {
        $data = $this->bookRepository->getBookData();
        $detail_book = $data->orderByChild('book_id')->equalTo($id)->getValue();
        $details = array_values($detail_book);
        $detail = $details[0];
        $all_book = $data->getValue();
        return view('page.detail', compact('detail', 'all_book'));
    }
}
