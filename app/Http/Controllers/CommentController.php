<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function comment() {
        return view('page.comment');
    }
    public function postComment(Request $request, $id) {
        $userData = new User();
        $users = $userData->getDatabase()->getValue();
        $commentData = new Comment();
        $data = $commentData->getDatabase();
        $user_key = session()->get('user_key');
        $postComment = [
            'book_id' => $id,
            'user_key' => $user_key[0],
            'user_name' => $users[$user_key[0]]['name'],
            'content' => $request->comment,
            'parent_id' => 0,
            'reply' => array()
        ];
        $data->push($postComment);
        return back();
    }

    public function listComment(Request $request, $id) {
        $commentData = new Comment();
        $data = $commentData->getDatabase();
        $dataComment = $data->orderByChild('book_id')->equalTo($id)->getValue();
        $comments = array_values($dataComment);
        return view('page.detail', compact('comments'));
    }

    public function reply(Request $request, $id) {
        dd($request->parent_id);
    }
}
