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
    /**
     * Lading page
     * Afiseaza portalele din cadrul browserului detectat.
     * Afiseaza portalul catre care se face redirect.
     */
    public function IndexAction(){
       $this->_portalService = new Model\PortalService();
       
       
       $browserAcronym = $this->_browserService->getBrowser();
       
       $browser = $this->_browserService->getBrowserByAcronym($browserAcronym);
       if($browser){
       $portals = $this->_portalService->getAllPortalsByBrowser($browser->getIdBrt());
       } else {
           $portals = array();
       }
       //Detect wich portal is shown
       
       $found = false;
       $selPrt = null;
       
       $sels = array();
       while(!$found && !empty($portals)){
           $chance = rand(1,100);
           foreach($portals as $prt){
               if($chance < $prt->getRates()[0]->getRate()){
                  array_push($sels , $prt);
                  $selPrt = $prt;
                  $found = true;
               }
           }
           
       }
       shuffle($sels);
       $selPrt = array_pop($sels);
       
       //Trimite datele catre view.
        
       $this->getView()->setVariable('browser' , $browser);
       $this->getView()->setVariable('portals' , $portals);
       $this->getView()->setVariable('selPortal' , $selPrt);
       $this->getView()->setVariable('change' , $chance);
       $this->getView()->render('index/index');
    }
     
 }