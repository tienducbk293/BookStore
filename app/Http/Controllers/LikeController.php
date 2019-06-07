<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Book;
class LikeController extends Controller
{
    protected $likeData;
    protected $bookData;
    public function __construct(Like $like, Book $book)
    {
        $this->likeData = $like;
        $this->bookData = $book;
    }

    public function addLike($id) {
        $user_key = session()->get('user_key');
        $child = 'book_id';
        $likeData = $this->likeData->orderByChild($child, $id);
        if (isset($likeData)) {
            $keys = array_keys($likeData);
            for ($i = 0; $i < count($likeData); $i++) {
                if ($likeData[$keys[$i]]['user_key'] === $user_key[0] && $likeData[$keys[$i]]['book_id'] === $id) {
                    return redirect()->back()->with('alert', 'Sản phẩm đã tồn tại trong danh sách yêu thích');
                }
            }
        } else {
            $postLike = [
                'book_id' => $id,
                'user_key' => $user_key[0],
                'like' => 1
            ];
            $this->likeData->getDatabase()->push($postLike);
        }
        $postLike = [
            'book_id' => $id,
            'user_key' => $user_key[0],
            'like' => 1
        ];
        $this->likeData->getDatabase()->push($postLike);
        return redirect()->back()->with('alert', 'Bạn đã thêm sản phẩm vào danh sách yêu thích');
    }
    public function getListLike($key) {
        $child = 'user_key';
        $data = $this->likeData->orderByChild($child, $key[0]);
        $likes = array_values($data);
        $books = array();
        foreach ($likes as $key => $like) {
            $book_id = (string) $like['book_id'];
            $book = $this->orderbyBookId($book_id);
            $books[$key] = $book;
        }
        return view('page.like', compact('books', $books));
    }

    public function orderbyBookId($id) {
        $child = 'book_id';
        $data = $this->bookData->orderByChild($child, $id);
        $books = array_values($data);
        return $book = $books[0];
    }
}
