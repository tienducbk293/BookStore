<?php

namespace App\Repositories;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class UserRepository {
    public function getUserToken($uid) {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/bookstore-firebase-adminsdk.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://bookstore-f7ae3.firebaseio.com')
            ->create();
        return $token = $firebase->getAuth()->createCustomToken($uid);
    }

    public function getUserData() {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/bookstore-firebase-adminsdk.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://bookstore-f7ae3.firebaseio.com')
            ->create();
        return $data = $firebase->getDatabase()->getReference('user');
    }
}