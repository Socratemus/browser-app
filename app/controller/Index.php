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
       //Detect wich portal is shown
       
       $found = false;
       $selPrt = null;
       while(!$found){
           $sels = array();
           $chance = rand(1,100);
           //echo 'Try with : ' .$chance . "<br/>";
           foreach($portals as $prt){
               //var_dump($prt); exit();
               if($chance < $prt->getRates()[0]->getRate()){
                  array_push($sels , $prt);
                  //echo $prt->getNamePrt()  . ' is a winner <br/>';
                  $selPrt = $prt;
                  $found = true;
               }
           }
           
       }
       shuffle($sels);
       $selPrt = array_pop($sels);
       
       $this->getView()->setVariable('browser' , $browser);
       $this->getView()->setVariable('portals' , $portals);
       $this->getView()->setVariable('selPortal' , $selPrt);
       $this->getView()->setVariable('change' , $chance);
       $this->getView()->render('index/index');
    }
     
 }