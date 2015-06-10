<?php

namespace app\model;

use vendor\Model as Model;

class BrowserService extends Model {
    
    public function __construct(){
        
        $this->__connection = $this->getConnection();
        
    }
    
    public function test() {
        
        echo 'testing the model <br />';
    }
    
    public function getBrowser(){
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
    
    public function getAllPortals(){
        $sql = "SELECT * FROM portals_prt
                
        "; //JOIN browser_portal ON (browser_portal.id_prt = portals_prt.id_prt)
        $stmt = $this->__connection->prepare($sql);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        //var_dump($return);exit();
        
        return $return;
    }
    
}