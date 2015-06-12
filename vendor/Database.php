<?php

namespace vendor;

class Database {
    
    public function __construct(){
        
    }
    
    /**
     * Returneaza o noua conexiune la baza de date
     * Driver folosit PDO
     */
    protected function connect(){
        $config = require 'app/config/database.php';
        $dsn = 'mysql:host='.$config['host'].';dbname=' . $config['dbname'];
        $dbh = new \PDO($dsn, $config['username'], $config['password'], $config['db_options']);
        return $dbh;
    }
    
    /**
     *  TODO
     *  Adauga metode simple de CRUD.
     */
     /*************************************************************************/
    
}