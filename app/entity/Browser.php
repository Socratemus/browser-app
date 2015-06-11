<?php

namespace app\entity;

class Browser implements EntityInterface {
    
    private $id_brt;
    private $acronym_brt;
    private $name_brt;
    private $keyword;
    
    private $rate;
    
    public function __construct(){
        
    }
    
    /* setters and getters */
    public function getIdBrt(){
        return $this->id_brt;
    }
    
    public function getAcronymBrt(){
        return $this->acronym_brt;
    }
    
    public function getNameBrt(){
        return $this->name_brt;
    }
    
    public function getKeywork(){
        return $this->keyword;
    }
    
    public function getRate(){
        return $this->rate;
    }
    
    public function setIdBrt($Id){
        $this->id_brt = $Id;    
    }
    
    public function setAcronymBrt($Acronym){
        $this->acronym_brt = $Acronym;
    }
    
    public function setNameBrt($Name){
        $this->name_brt = $Name;
    }
    
    public function setKeyword($Keyword){
        $this->keyword = $Keyword;
    }
    
    public function setRate($Rate){
         $this->rate = $Rate;
    }
    public function exchange($Data){
        if(isset($Data['id_brt'])){
            $this->setIdBrt($Data['id_brt']);
        }
        if(isset($Data['acronym_brt'])){
            $this->setAcronymBrt($Data['acronym_brt']);
        }
        if(isset($Data['name_brt'])){
            $this->setNameBrt($Data['name_brt']);
        }
        if(isset($Data['keyword'])){
            $this->setKeyword($Data['keyword']);
        }
    }
}

