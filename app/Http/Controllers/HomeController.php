<?php

namespace App\Http\Controllers;

require_once('../vendor/autoload.php');

use DiDom\Query;
use Illuminate\Http\Request;
use Curl\Curl;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Illuminate\Support\Facades\Session;
use Firebase\Auth\Token\Exception\InvalidToken;
class HomeController extends Controller
{
    public function index () {
        $firebase = $this->getFirebase();
        $data = $firebase->getDatabase()->getReference('book');
        $all_book = $data->getValue();
        return view('page.homepage', compact('all_book'));
    }
    public function getDetailBook ($bookId) {
        $firebase = $this->getFirebase();
        $data = $firebase->getDatabase()->getReference('book');
        $detail_book = $data->orderByChild('book_id')->equalTo($bookId)->getValue();
        $details = array_values($detail_book);
        $detail = $details[0];
        $all_book = $data->getValue();
        return view('page.detail', compact('detail', 'all_book'));
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
        $user['email'] = $request->email;
        $user['name'] = $request->name;
        $user['password'] = Hash::make($request->password);
        $user['re_password'] = Hash::make($request->re_password);
        $firebase = $this->getFirebase();
        $data = $firebase->getDatabase()->getReference('user');
        $data->push($user);
        return redirect('login')->with('success', 'Tạo tài khoản thành công');
    }

    public function getAddToCart (Request $req, $bookId) {
        $firebase = $this->getFirebase();
        $data = $firebase->getDatabase()->getReference('book');
        $bookData = $data->orderByChild('book_id')->equalTo($bookId)->getValue();
        $books = array_values($bookData);
        $book = $books[0];

        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($book,$bookId);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function listUser($email) {
        $firebase = $this->getFirebase();
        $auth = $firebase->getAuth();

        $userByEmail = $auth->getUserByEmail($email);
        $user = get_object_vars($userByEmail);
        return $uid = $user['uid'];
    }
    public function createCustomToken($email) {
        $firebase = $this->getFirebase();
        $uid = $this->listUser($email);
        $token = $firebase->getAuth()->createCustomToken($uid);
        return $customToken = (string) $token;
    }
    public function test () {
        return $this->createCustomToken('admin@gmail.com');
    }
    public function verifyIdToken() {
        $idTokenString = $this->createCustomToken('admin@gmail.com');
        $firebase = $this->getFirebase();
        try {
            $verifiedIdToken = $firebase->getAuth()->verifyIdToken($idTokenString);
            $uid = $verifiedIdToken->getClaim('sub');
            return $user = $firebase->getAuth()->getUser($uid);
        } catch (InvalidToken $e) {
            echo $e->getMessage();
        }


    }
}
