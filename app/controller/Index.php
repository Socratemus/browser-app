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
       $this->_portalService = new Model\PortalService();
       
       
       $browserAcronym = $this->_browserService->getBrowser();
       
       $browser = $this->_browserService->getBrowserByAcronym($browserAcronym);
       $portals = $this->_portalService->getAllPortalsByBrowser($browser->getIdBrt());
       //var_dump($portals);exit();
       $this->getView()->setVariable('browser' , $browser);
       
       $this->getView()->setVariable('portals' , $portals);
       
       $this->getView()->render('index/index');
    }
     
 }