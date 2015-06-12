<?php
    namespace vendor;
    
    class Model extends Database {
        
        protected $Db = null;
        private $__connection;
        protected static $Instance;
        
        /**
         * Intoarce conexiunea la baza de date.
         */
        public function getConnection() {
            if (!$this->___connection) {
                $this->initDb();
                $this->__connection = $this->Db->connect();
            }
            return $this->__connection;
        }
        
        /**
         *  Singletone - Intoarce o instanta proprie. 
         */
        public static function getInstance(){
            if (self::$Instance == null) {
                self::$Instance = new Model();
            }
            return self::$Instance;
        }   
        
        /**
         * Creaza o noua instanta Database.
         */
        private function initDb(){
            if (!$this->Db)
                $this->Db = new Database();
        }  
    }

?>