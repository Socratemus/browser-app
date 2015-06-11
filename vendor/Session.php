<?php

namespace vendor;
    
class Session {
    
    public function __construct(){
        
    }
    
    public static function setFlashMessage($Key , $Value){
        $_SESSION[$Key] = $Value;
    }
    
    public static function getFlashMessage($Key){
        if(isset($_SESSION[$Key])) {
            $value = $_SESSION[$Key];
            unset($_SESSION[$Key]);
            return $value;
        } else {
            return null;
        }
    }
    
    
}    
    