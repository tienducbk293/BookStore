<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Comment;
use App\Book;
use App\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $bookData ;
    protected $commentData;
    public function __construct(Book $book, Comment $comment)
    {
        $this->bookData = $book;
        $this->commentData = $comment;
    }

    public function index () {
        $all_book = $this->bookData->getAll();
        return view('page.homepage', compact('all_book'));
    }

    public function getDetailBook (Request $request, $id) {
        $childBook = 'book_id';
        $comments = $this->commentData->getDatabase()->orderByChild('book_id')->equalTo($id)->getValue();
        if (empty($comments) || !isset($comments)) {
            $everage = 0;
        } else {
            $sum = 0;
            foreach ($comments as $key => $comment) {
                $sum += $comment['rating'];
            }
            $everage = round($sum/count($comments), 2);
        }
        $detail_book = $this->bookData->orderByChild($childBook, $id);
        $details = array_values($detail_book);
        $detail = $details[0];
        $all_book = $this->bookData->getAll();
        $slug = explode("/", $detail['slug']);
        $category_books = $this->getCategoryBook($all_book, $slug[0]);
        if (session()->has('token') && session()->get('login') == true) {
            $this->getSeenBook($request, $detail, $id);
        }
        return view('page.detail', compact('detail', 'all_book', 'comments', 'everage', 'category_books'));
    }

    public function getSeenBook(Request $request, $detail, $id) {
        $seen_books = session()->get('seen_books');
        if (!$seen_books) {
            $seen_books[$id] = $detail;
            $request->session()->put('seen_books', $seen_books);
            return $seen_books;
        }
        if(isset($seen_books[$id])) {
            return $seen_books;
        } else {
            $seen_books[$id] = $detail;
            $request->session()->put('seen_books', $seen_books);
            return $seen_books;
        }
    }

    public function getCategoryBook($all_book, $slug) {
        $category_books = array();
        foreach ($all_book as $key => $all) {
            $pos = strpos($all['slug'], $slug);
            if ($pos !== false) {
                $category_books[$key] = $this->bookData->orderByKey($key);
            }
        }
        return $category_books;
    }

    public function category(Request $request, $slug) {
        $books = $this->bookData->getAll();
        $category_books = array();
        foreach ($books as $key => $book) {
            $pos = strpos($book['slug'],$slug);
            if ($pos !== false) {
                $category_books[$key] = $this->bookData->orderByKey($key);
            }
        }
        $paginate_books = array();
        $amount = count($category_books);
        if ($amount > 9) {
            $paginate = ceil($amount/9);
            for ($i = 0; $i < $paginate; $i++) {
                $paginate_books[$i] = array_slice($category_books, 9*$i, 9);
            }
        }
        return view('page.category', compact('category_books', 'amount', 'paginate_books', 'paginate'));
    }

    function vn_str_filter ($str){
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    public function search(Request $request) {
        $searchString = $request->search;
        $search = strtolower($this->vn_str_filter($searchString));
        $books = $this->bookData->getAll();
        $searchs = array();
        foreach ($books as $key => $book) {
            $strFilter = $this->vn_str_filter($book['title']);
            $title = strtolower($strFilter);
            $pos = strpos($title, $search);
            if ($pos !== false) {
                $searchs[$key] = $this->bookData->orderByKey($key);
            }
        }
        $amount = count($searchs);
        return view('page.search', compact('searchs', 'amount'));
    }

    public function test() {
        return view('page.test');
    }
}
