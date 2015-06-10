<?php
    namespace vendor;
    
    class Model extends Database {
        
        protected $Db = null;
        
        private $__connection;
        protected static $Instance;
        
        public function getConnection() {
            if (!$this->___connection) {
                $this->initDb();
                $this->__connection = $this->Db->connect();
            }
            return $this->__connection;
        }
        
        public static function getInstance(){
            if (self::$Instance == null) {
                self::$Instance = new Model();
            }
            return self::$Instance;
        }   
        
        private function initDb(){
            if (!$this->Db)
                $this->Db = new Database();
        }  
    }

?>