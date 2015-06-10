<?php

namespace vendor;

class Database {
    
    public function __construct(){
        
    }
    
    protected function connect(){
        $config = require 'app/config/database.php';
        $dsn = 'mysql:host='.$config['host'].';dbname=' . $config['dbname'];
        $dbh = new \PDO($dsn, $config['username'], $config['password'], $config['db_options']);
        return $dbh;
    }
    
}