<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Book;
class LikeController extends Controller
{
    public function addLike(Request $request, $id) {
        $like = new Like();
        $dataLike = $like->getDatabase();
        $user_key = session()->get('user_key');
        $likeData = $dataLike->orderByChild('book_id')->equalTo($id)->getValue();
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
            $dataLike->push($postLike);
        }
        $postLike = [
            'book_id' => $id,
            'user_key' => $user_key[0],
            'like' => 1
        ];
        $dataLike->push($postLike);
        return redirect()->back()->with('alert', 'Bạn đã thêm sản phẩm vào danh sách yêu thích');
    }
    public function getListLike(Request $request, $key) {
        $like = new Like();
        $dataLike = $like->getDatabase();
        $likeData = $dataLike->orderByChild('user_key')->equalTo($key)->getValue();
        $likes = array_values($likeData);
        $books = array();
        foreach ($likes as $key => $like) {
            $book_id = (string) $like['book_id'];
            $book = $this->orderbyBookId($book_id);
            $books[$key] = $book;
        }
        return view('page.like', compact('books', $books));
    }

    public function orderbyBookId($id) {
        $bookData = new Book();
        $data = $bookData->getDatabase();
        $dataBook = $data->orderByChild('book_id')->equalTo($id)->getValue();
        $books = array_values($dataBook);
        return $book = $books[0];
    }
}
