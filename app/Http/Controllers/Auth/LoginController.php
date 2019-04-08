<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function createCustomToken($uid) {
        $firebase = $this->getFirebase();
        $token = $firebase->getAuth()->createCustomToken($uid);
        return $customToken = (string) $token;
    }
    public function getLogin () {
        return view('page.login');
    }
    public function postLogin (Request $request) {
        $firebase = $this->getFirebase();
        $data = $firebase->getDatabase()->getReference('user');
        $user_detail = $data->orderByChild('email')->equalTo($request->email)->getValue();
        $users = array_values($user_detail);
        $user = $users[0];

        $uid = key($user_detail);
        $customToken = $this->createCustomToken($uid);
        $request->session()->put('token', $customToken);
        $request->session()->put('name', $user['name']);
        $request->session()->put('login', true);
        if (Hash::check($request->password, $user['password']) && ($user['email'] = $request->email)) {
            return redirect('home');
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập không thành công']);
        }
    }
    public function getLogout (Request $request) {
        $request->session()->flush();
        return redirect('home');
    }
}
