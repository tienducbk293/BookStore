<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class RegisterController extends Controller
{
    use RegistersUsers;

    public function showRegistrationForm () {
        return view('auth.register');
    }

    public function register (Request $request) {
        $user = array(
            'email' => null,
            'name' => null,
            'password' => null,
            'password_confirmation' => null
        );
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        if ($password === $password_confirmation) {
            $user['password'] = Hash::make($password);
        }
        $user['email'] = $request->input('email');
        $user['name'] = $request->input('name');
        $user['level'] = '1';
        $userData = new User();
        $data = $userData->getDatabase();
        $data->push($user);
        return redirect('login')->with('success', 'Tạo tài khoản thành công');
    }
}
