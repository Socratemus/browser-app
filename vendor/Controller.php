<?php

namespace vendor;

//The controller class...

class Controller {
    
    protected $__view;
    
    public function __construct(){
        
        echo 'on controller construct <br />';
    }
    
    protected function initView () {
        $this->__view = new View();
    }
    
    protected function getView(){
        return $this->__view;
    }
    
    protected function redirect( $Token ) {
        $path = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/?q=';
       
        $path .= $Token;
        
        header("Location: $path");
    }
    
}