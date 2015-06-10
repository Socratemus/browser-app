<?php

namespace app\controller;

use vendor\Controller as Controller;
use app\model as Model;

/**
 * Index controller - 
 * Application entry point
 */
 
 class Index extends Controller {
     
    private $_browserService = null;
     
    public function __construct(){
       
       $this->initView();
       $this->_browserService = new Model\BrowserService();
       
    }
    
    public function IndexAction(){
       
       $portals = $this->_browserService->getAllPortals();
       
       $this->getView()->setVariable('portals' , $portals);
       
       $this->getView()->render('index/index');
    }
     
 }