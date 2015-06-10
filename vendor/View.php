<?php

namespace vendor;

class View {
    
    const PATH = 'app/view';
    
    public function __construct(){
        
    }
    
    public function render($name , $admin = false){
        
        if($admin) {
            //require 'views/header.php';
            require 'views/' . $name . '.php';
            //require 'views/footer.php';
        } else {
            require self::PATH .'/layout/header.php';
            require self::PATH . '/' . $name . '.php';
            require self::PATH .'/layout/footer.php';
        }
    }
    
    public function setVariable($name , $value){
        $this->{$name} = $value;
    }
    
    public function setVariables( $variables ){
        foreach($variables as $key => $value){
            $this->setVariable($key , $value);
        }
    }
}