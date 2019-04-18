<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;
class RegisterController extends Controller
{
    use RegistersUsers;
    private $userRepository;

    public function __construct(UserRepository $userRepository = null)
    {
        $this->userRepository = ($userRepository === null) ? new UserRepository : $userRepository;
    }

    public function getRegister () {
        return view('page.register');
    }

    public function postRegister (Request $request) {
        $user = array(
            'email' => null,
            'name' => null,
            'password' => null,
            're_password' => null
        );
        $user['email'] = $request->input('email');
        $user['name'] = $request->input('name');
        $user['password'] = Hash::make($request->input('password'));
        $user['re_password'] = Hash::make($request->input('re_password'));
        $data = $this->userRepository->getUserData();
        $data->push($user);
        return redirect('login')->with('success', 'Tạo tài khoản thành công');
    }
}
