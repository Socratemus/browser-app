<?php

namespace vendor;

class Router {
    
    private $_params;
    
    const DEFAULT_CONTROLLER  = 'Index';
    const DEFAULT_METHOD  = 'IndexAction';
    
    public function __construct(){
        //Verificam sa avem ruta asteptata
        if(! isset( $_GET['q']) || empty( $_GET['q'] )) {
            exit('there is no query params... cant route it!');
        }
        $q = $_GET['q'];
        $tmp = explode('/' , $q);
        $this->_params = $tmp;
        unset($tmp);
    }
    
    public function getController(){
        return isset($this->_params[0]) ? ucfirst($this->_params[0]) : self::DEFAULT_CONTROLLER;
    }
    
    public function getMethod(){
        return isset($this->_params[1]) ? ucfirst($this->_params[1]) . 'Action' : self::DEFAULT_METHOD;
    }
    
    
    
}