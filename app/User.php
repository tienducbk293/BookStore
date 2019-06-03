<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class User extends Model
{
    protected $firebase;
    protected $dbname='users';
    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/bookstore-firebase-adminsdk.json');
        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://bookstore-f7ae3.firebaseio.com')
            ->create();
    }

    public function firebase() {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/bookstore-firebase-adminsdk.json');
        return $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://bookstore-f7ae3.firebaseio.com')
            ->create();
    }

    public function database() {
        return $this->firebase->getDatabase()->getReference($this->dbname);
    }

    public function getAll() {
        return $this->database()->getValue();
    }

    public function getToken($uid) {
        $firebase = $this->firebase();
        return $token = $firebase->getAuth()->createCustomToken($uid);
    }

    public function orderBy($child, $value) {
        return $this->firebase->getDatabase()->getReference($this->dbname)->orderByChild($child)->equalTo($value)->getValue();
    }

    public function get(int $userID = null) {
        if (empty($userID) || !isset($userID)) { return false; }
        if ($this->firebase->getDatabase()->getReference($this->dbname)->getSnapshot()->hasChild($userID)) {
            return $this->firebase->getDatabase()->getReference($this->dbname)->getChild($userID)->getValue();
        } else {
            return false;
        }
    }

    public function insert(array $data) {
        if (empty($data) || !isset($data)) { return FALSE; }
        foreach ($data as $key => $value){
            $this->firebase->getDatabase()->getReference()->getChild($this->dbname)->getChild($key)->set($value);
        }
        return TRUE;
    }

    public function delete(int $userID = null) {
        if (empty($userID) || !isset($userID)) { return FALSE; }
        if ($this->firebase->getDatabase()->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
            $this->firebase->getDatabase()->getReference($this->dbname)->getChild($userID)->remove();
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
