<?php

namespace vendor;

class View {
    
    const PATH = 'app/view';
    
    public $doctype = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    public $meta = 'default meta description';

    public $javascriptFiles = array();
    public $cssFiles = array();

    public function __construct(){
        
        $this->javascriptFiles [] = '/assets/addons/jquery/jquery-2.1.4.js';
        $this->javascriptFiles [] = '/assets//addons/bootstrap-3.3.4-dist/js/bootstrap.js';
        $this->javascriptFiles [] = '/assets/js/global.js';
        $this->cssFiles[] = '/assets/addons/bootstrap-3.3.4-dist/css/bootstrap.css';
        $this->cssFiles[] = '/assets/addons/font-awesome-4.3.0/css/font-awesome.css';
        $this->cssFiles[] = '/assets/css/global.css';
    }
    
    public function render($name , $admin = false){
        
        if($admin) {
            require self::PATH .'/layout/admin-header.php';
            require self::PATH . '/' . $name . '.php';
            require self::PATH .'/layout/admin-footer.php';
        } else {
            require self::PATH .'/layout/header.php';
            require self::PATH . '/' . $name . '.php';
            require self::PATH .'/layout/footer.php';
        }
    }
    
    public function setVariable($Name , $Value){
        $this->{$Name} = $Value;
    }
    
    public function setVariables( $Variables ){
        foreach($Variables as $key => $value){
            $this->setVariable($key , $value);
        }
    }
    
    public function setMeta($Meta){
        $this->meta = $Meta;
    }
    
    public function getMeta(){
        return $this->meta;
    }
    
    public function setDoctype($Doctype){
        $this->doctype = $Doctype;
    }
    
    public function getDoctype(){
        return $this->doctype;
    }
    
    public function url($Token , $QueryParams = array()){
        
        //$params = explode('/',$Token);
        
        //$ctrl = $params[0];
        
        $path = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/?q=';
       
        $path .= $Token;
        
        foreach($QueryParams as $key => $value) {
            $path .= '&' . $key . '=' . $value;
        }
        
        return $path;
        
    }
}