<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
use Session;
class LoginController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository = null)
    {
        $this->userRepository = ($userRepository === null) ? new UserRepository : $userRepository;
    }

    public function createCustomToken($uid) {
        $token = $this->userRepository->getUserToken($uid);
        return $customToken = (string) $token;
    }

    public function getLogin () {
        return view('page.login');
    }

    public function postLogin (Request $request) {
        $data = $this->userRepository->getUserData();
        $user_detail = $data->orderByChild('email')->equalTo($request->email)->getValue();
        $users = array_values($user_detail);
        $user = $users[0];

        $uid = key($user_detail);
        $customToken = $this->createCustomToken($uid);
        $request->session()->put('token', $customToken);
        $request->session()->put('name', $user['name']);
        $request->session()->put('login', true);
        if (Hash::check($request->password, $user['password']) && ($user['email'] = $request->email)) {
            return redirect('/');
        } else {
            return redirect('login')->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }

    public function getLogout (Request $request) {
        $request->session()->flush();
        return redirect('/');
    }
}
