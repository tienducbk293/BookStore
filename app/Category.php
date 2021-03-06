<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
class Category extends Model
{
    protected $database;
    protected $dbname = 'categories';
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
}
