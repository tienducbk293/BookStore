<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Session;
class LoginController extends Controller
{
    protected $userData;
    public function __construct(User $userData)
    {
        $this->userData = $userData;
    }

    public function createCustomToken($uid) {
        $token = $this->userData->getToken($uid);
        return $customToken = (string) $token;
    }

    public function showLoginForm () {
        session()->put('url.intended', URL::previous());
        return view('auth.login');
    }

    public function login(Request $request) {
        $child = 'email';
        $user_detail = $this->userData->orderBy($child, $request->email);
        $users = array_values($user_detail);
        $user = $users[0];
        $user_key = array_keys($user_detail, $user);
        $uid = key($user_detail);
        $customToken = $this->createCustomToken($uid);
        $request->session()->put('token', $customToken);
        $request->session()->put('user_key', $user_key[0]);
        $request->session()->put('user_name', $user['name']);
        $request->session()->put('level', $user['level']);
        $request->session()->put('login', true);
        if (Hash::check($request->password, $user['password']) && ($user['email'] = $request->email)) {
            if (session()->get('url.intended') === url('register')) {
                return redirect('/');
            } else {
                return redirect()->to(session()->get('url.intended'));
            }
        } else {
            return redirect('login')->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }

    public function getLogout (Request $request) {
        $request->session()->flush();
        return redirect()->back();
    }
}
