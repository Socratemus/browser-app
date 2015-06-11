<?php

namespace app\model;

use vendor\Model as Model;

class BrowserService extends Model {
    
    public function __construct(){
        
        $this->__connection = $this->getConnection();
        
    }
    
    public function getBrowser(){ // Ar trebui mutat intrun Util ::getBrowser -> + sa intoarca IE
        if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
            return 'Internet explorer';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
            return "Opera Mini";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
            return "Opera";
        elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
            return "Safari";
        else
            return 'Unknown';
    }
    
    public function getPortal(){
        
        
        return 'something';
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
    
}