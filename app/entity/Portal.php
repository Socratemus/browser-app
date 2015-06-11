<?php

namespace app\entity;

class Portal implements EntityInterface {
    
    private $id_prt;
    
    private $name_prt;
    
    private $url_prt;
    
    protected $rates = array();
    
    public function __construct(){
        
    }
    
    public function getIdPrt(){
        return $this->id_prt;
    }
    
    public function getNamePrt(){
        return $this->name_prt;
    }
    
    public function getUrlPrt(){
        return $this->url_prt;
    }
    
    public function getRates(){
        return $this->rates;
    }
    
    public function setIdPrt($Id){
        $this->id_prt = $Id;
        return $this;
    }
    
    public function setNamePrt($Name){
        $this->name_prt  =$Name;
        return $this;
    }
    
    public function setUrlPrt($Url){
        $this->url_prt = $Url;
        return $this;
    }
    
    public function setRates($Rates){
        $this->rates = $Rates;
        return $this;
    }
    
    public function exchange($Data) {
        
        if(isset($Data['id_prt'])){
            $this->setIdPrt($Data['id_prt']);
        }
        
        if(isset($Data['name_prt'])){
            $this->setNamePrt($Data['name_prt']);
        }
        
        if(isset($Data['url_prt'])){
            $this->setUrlPrt($Data['url_prt']);
        }
        
        return $this;
    }
    
}