<?php

namespace app\model;

use vendor\Model as Model;

class BrowserService extends Model {
    
    public function __construct(){
        
        $this->__connection = $this->getConnection();
        
    }
    
    public function getBrowser(){ // Ar trebui mutat intrun Util ::getBrowser -> + sa intoarca IE
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
            return 'IE';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
            return 'IE';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
            return 'FF';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
            return 'GC';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
            return "OM";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
            return "OP";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
            return "SF";
        else
            return 'UNK';
    }
    
    public function getAllBrowsers(){
        $sql = "SELECT * FROM browser_types_brt";
        $stmt = $this->__connection->prepare($sql);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        if(empty($return)) {
            return array();
        } 
        
        //Hydrate data
        $ret = array();
        foreach($return as $dataset){
            $brs = new \app\entity\Browser();
            $brs->exchange($dataset);
            array_push($ret,$brs);
            unset($brs);
        }
      
        return $ret;
    }
    
    public function getBrowserByAcronym($Acronym){
        //echo $Acronym;exit();
        
        $sql = "SELECT * FROM browser_types_brt bt WHERE bt.acronym_brt = :acronym_brt";
        $stmt = $this->__connection->prepare($sql);
        $stmt->bindParam(':acronym_brt' , $Acronym);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(isset($return[0])){
            $browser = new \app\entity\Browser();
            $browser->exchange($return[0]);
            return $browser; 
        } else {
            return null;
        }
        var_dump($return);
        exit();
    }
    
}