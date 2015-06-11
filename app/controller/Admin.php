<?php

namespace app\controller;

use vendor\Controller as Controller;
use app\model as Model;

/**
 * Admin controller - 
 * Application Admin 
 */
 
 class Admin extends Controller {
     
    public function __construct(){
       
       $this->initView();
       $this->_browserService = new Model\BrowserService();
       
    }
    
    public function IndexAction(){
       $portals = $this->_browserService->getAllPortals();
       $this->getView()->setVariable('portals' , $portals);
       $this->getView()->render('admin/index',true);
    }
    
    public function NewAction(){
       $browsers = $this->_browserService->getAllBrowsers();
       $this->getView()->setVariable('browsers' , $browsers);
       $this->getView()->render('admin/new',true);
    }
    
    public function NewPostAction(){
       
       try {
        
         if(!isset($_POST) || empty($_POST)){
           exit('invalid request'); 
         }
         
         $data = $_POST;
         
         $this->_browserService->addPortal($data);
         
         $this->redirect('admin/index');
         
       } catch(\Exception $e) {
         
         //echo $e->getMessage();
         \vendor\Session::setFlashMessage('validation' , $e->getMessage());
         $this->redirect('admin/new');
       }
       //Check post with controller method!
    }
    
    public function EditAction(){
       try {
          
          $this->_portalService = new Model\PortalService();
          
          if(!isset($_GET['id']) || empty($_GET['id'])){
              throw new \Exception('Invalid portal id.');
          }
          
          $portalId = $_GET['id'];
      
          $browsers = $this->_browserService->getAllBrowsers();
          $portal = $this->_portalService->getPortalById($portalId);
         
          $this->getView()->setVariable('portal' , $portal);
          $this->getView()->setVariable('rates' , $portal);
          $this->getView()->setVariable('browsers' , $browsers);
          
          $this->getView()->render('admin/edit',true);
       } catch( \Exception $e){
          \vendor\Session::setFlashMessage('validation' , $e->getMessage());
          $this->redirect('admin/index');
       }
    }
     
    public function EditPostAction(){
     
      try
      {
          if(!isset($_POST) || empty($_POST)){
             exit('invalid request'); 
          }
           
          $data = $_POST;
            
          $this->_portalService = new Model\PortalService(); 
          $this->_portalService->updatePortal($data);
          exit('updated');         
          $this->redirect('admin/index');

      } 
      catch(\Exception $e)
      {
          \vendor\Session::setFlashMessage('validation' , $e->getMessage());
          $this->redirect('admin/index');
      }
         
     
     
    }
        
 }