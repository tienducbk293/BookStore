<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\User;
class CommentController extends Controller
{
    protected $userData;
    protected $commentData;
    public function __construct(User $user, Comment $comment)
    {
        $this->userData = $user;
        $this->commentData = $comment;
    }

    public function comment() {
        return view('page.comment');
    }
    public function postComment(Request $request, $id) {
        $data = $this->commentData->getDatabase();
        $user_key = session()->get('user_key');
        $user_name = session()->get('name');
        $postComment = [
            'book_id' => $id,
            'user_key' => $user_key,
            'user_name' => $user_name,
            'content' => $request->comment,
            'rate' => $request->rate,
            'parent_id' => 0,
            'reply' => array()
        ];
        $data->push($postComment);
        return redirect()->back();
    }

//    public function listComment($id) {
//        $child = 'book_id';
//        $comments = $this->commentData->orderByChild($child, $id);
//        return view('page.detail', compact('comments'));
//    }

    public function reply(Request $request, $id) {
        dd($request->parent_id);
    }

    public function rate() {
        return view('page.rate');
    }
}
