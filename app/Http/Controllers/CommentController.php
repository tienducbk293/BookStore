<?php

namespace App\Http\Controllers;

use DateTime;
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
        $user_name = session()->get('user_name');
        $date_create = new DateTime();
        $postComment = [
            'book_id' => $id,
            'user_key' => $user_key,
            'user_name' => $user_name,
            'content' => $request->comment,
            'rating' => $request->rating,
            'date_create' => $date_create,
        ];
        $data->push($postComment);
        return redirect()->back();
    }

    public function editComment(Request $request, $id) {
        $child = 'book_id';
        $comments = $this->commentData->orderByChild($child, $id);
        foreach ($comments as $key => $comment) {
            if ($comment['user_key'] === session()->get('user_key')) {
                $edit = [
                    'book_id' => $comment['book_id'],
                    'content' => $request->comment,
                    'date_create' => new DateTime(),
                    'rating' => $request->rating,
                    'user_key' => $comment['user_key'],
                    'user_name' => $comment['user_name'],
                ];
                $this->commentData->getDatabase()->getChild($key)->set($edit);
            }
        }
        return redirect()->back();
    }

    public function deleteComment($key) {
        $this->commentData->getDatabase()->getChild($key)->remove();
        return redirect()->back();
    }

    public function reply(Request $request, $id) {
        dd($request->parent_id);
    }

    public function rate() {
        return view('page.rate');
    }
}
