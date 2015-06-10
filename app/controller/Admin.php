<?php

namespace app\controller;

use vendor\Controller as Controller;

/**
 * Admin controller - 
 * Application Admin 
 */
 
 class Admin extends Controller {
     
    public function __construct(){
       
       $this->initView();
       
       //echo 'index controller costructor <br />';
    }
    
    public function IndexAction(){
       //echo 'in actiunea de index...';
       
       
       echo 'welcome to admin...';
    }
     
 }