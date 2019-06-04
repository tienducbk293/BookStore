<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use willvincent\Rateable\Rateable;

class Comment extends Model
{
    use Rateable;

    protected $database;
    protected $dbname = 'comments';
    public function __construct()
    {
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/bookstore-firebase-adminsdk.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://bookstore-f7ae3.firebaseio.com')
            ->create();
        $this->database = $firebase->getDatabase();
    }

    public function getDatabase() {
        return $this->database->getReference($this->dbname);
    }

    public function getAll() {
        return $this->database->getReference($this->dbname)->getValue();
    }

    public function orderByChild($child, $value) {
        return $this->database->getReference($this->dbname)->orderByChild($child)->equalTo($value)->getValue();
    }
}
