<?php

namespace vendor;

class Bootstrap {
    
    const DEFAULT_CONTROLLER = 'Index';
    const DEFAULT_METHOD = 'IndexAction';
    
    public static $Controller;
    public static $Method;
    
    private $_router;
    private $_controller;
    private $_model;

    
    public  function __construct() {
        require_once 'app/config/constants.php';
        $this->_router = new Router();
        $this->delegateController();
        $this->delegateMethod();
        $this->run();
    }
    
    /**
     * Instantiaza controllerul.
     */
    private function delegateController(){
        $ctrl = $this->_router->getController();
        $ctrlPath = '\app\controller\\' . $ctrl;
        if(class_exists( $ctrlPath )){
            $this->_controller = new $ctrlPath();
        } else {
            //404
            $this->notFoundAction();
        }
    }
    
    /**
     * Seteaza metoda.
     */
    private function delegateMethod(){
        $mtd = $this->_router->getMethod();
        
        if(method_exists($this->_controller , $mtd)) {
            $this->_method = $mtd;
        } else if(method_exists($this->_controller , self::DEFAULT_METHOD)){
            $this->_method = self::DEFAULT_METHOD;
        } else {
            $this->notFoundAction();
        }
        
    }
    
    /**
     *  Apelam metoda din controller. 
     */
    private function run(){
        @session_start();
        self::$Controller = get_class($this->_controller);
        self::$Method = $this->_method;
        //Trebuie sa pasam si parametrii metodei la apelare
        $params = array();
        $this->_controller->{$this->_method}($params);
        //Sau apelare cu call_func
        
    }
    
    private function notFoundAction(){
        echo 'page not found!';
        exit();
    }
}