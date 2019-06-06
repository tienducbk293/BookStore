<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userData;
    public function __construct(User $user)
    {
        $this->userData = $user;
    }

    public function getList() {
        $list_users = $this->userData->getAll();
        return view('admin.user.list', compact('list_users'));
    }

    public function getAdd () {
        return view('admin.user.add');
    }

    public function postAdd(Request $request) {
        $user = array(
            'email' => null,
            'name' => null,
            'password' => null
        );
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        if ($password === $password_confirmation) {
            $user['password'] = Hash::make($password);
        }
        $user['email'] = $request->input('email');
        $user['name'] = $request->input('name');
        $user['level'] = $request->input('level');
        $this->userData->database()->push($user);
        return redirect()->route('user.list')->with(['flash_message', 'Thêm mới thành viên thành công']);
    }

    public function getEdit($key) {
        $user = $this->userData->orderByKey($key);
        return view('admin.user.edit', compact('user', 'key'));
    }

    public function postEdit(Request $request, $key) {
        $user = $this->userData->orderByKey($key);
        if (session()->get('user_key') === $key) {
            if ($request->input('password') === $request->input('password_confirmation')) {
                $password = Hash::make($request->input('password'));
            }
            $user = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $password,
                'level' => $user[$key]['level'],
            ];
            $this->userData->database()->getChild($key)->set($user);
        } else {
            $user = [
                'name' => $user[$key]['name'],
                'email' => $user[$key]['email'],
                'password' => $user[$key]['password'],
                'level' => $request->input('level')
            ];
            $this->userData->database()->getChild($key)->set($user);
        }
        return redirect()->route('user.list')->with(['flash_message', 'Thay đổi thông tin thành công']);
    }

    public function delete($key) {
        $this->userData->database()->getChild($key)->remove();
        return redirect()->route('user.list')->with(['flash_message', 'Xóa thành viên thành công']);
    }
}
