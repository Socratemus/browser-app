<?php

namespace app\model;

use vendor\Model as Model;

class PortalService extends Model {
    
    public function __construct(){
        
        $this->__connection = $this->getConnection();
        
    }
    
    /**
     * Intoarce toate portalele.
     */
    public function getAllPortals(){
        /*
        select pp.id_prt AS PortalId , pp.name_prt AS PortalName,
        	pp.url_prt AS PortalUrl,
         	bp.rate AS PortalRate,
        	btb.name_brt AS BrowserName,
        	btb.acronym_brt as BrowserAcronim,
        	btb.keyword as BrowserKeyword
        
        from portals_prt pp
        left JOIN browser_portal bp on (bp.id_prt = pp.id_prt)
        left join browser_types_brt btb on (btb.id_brt = bp.id_brt )
        */
        
        $sql = "SELECT * FROM portals_prt
                
        ";
        $stmt = $this->__connection->prepare($sql);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $return;
    }
    
    /**
     *  Intoarce un portal dupa Id. 
     */
    public function getPortalById($Id){
        
        $sql = "SELECT pp.*, bp.rate , btb.* FROM `portals_prt` as pp
                JOIN browser_portal as bp ON (bp.id_prt = pp.id_prt)
                JOIN browser_types_brt btb ON (btb.id_brt = bp.id_brt)
                where pp.id_prt = :id
            ";
        $stmt = $this->__connection->prepare($sql);
        $stmt->bindValue(':id', $Id);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(!isset($return[0])){
            return null;
        }
        $portal = new \app\entity\Portal();
        $portal->exchange($return[0]);
        
        $rates = array(); 
        foreach($return as $dataset){
            
            $brs = new \app\entity\Browser();
            $brs->exchange($dataset);
            $brs->setRate($dataset['rate']);
            $rates[$brs->getIdBrt()] = $brs;
            unset($brs);
        }
        $portal->setRates($rates);
        
        return $portal;
    }
    
    /**
     * Selecteaza un portal dupa nume sau link.
     */
    public function getPortalByNameOrLink($Name, $Link){
        try {
            $sql = "SELECT pp.id_prt FROM portals_prt pp
                WHERE pp.name_prt = :name OR pp.url_prt = :link
            ";
            $stmt = $this->__connection->prepare($sql);
            $stmt->bindParam(':name', $Name);
            $stmt->bindParam(':link', $Link);
            $stmt->execute();
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(isset($return[0])){
                //Hydrate result
                return $return[0];
            } else {
                return null;
            }
        } catch(\Exception $e){
            \vendor\Session::setFlashMessage('exception' , $e->getMessage());
            return null;
        }
        
    }
    
    /**
     * Adauga un portal nou. 
     */
    public function addPortal( $Data) {
        try { 
            $this->validatePortal($Data);
            $sql = 'INSERT INTO portals_prt(name_prt , url_prt) VALUES (:name_prt  , :url_prt)';
            $stmt = $this->__connection->prepare($sql);
            //$this->__connection->beginTransaction();
            $stmt->bindParam(':name_prt', $Data['name_prt']);
            $stmt->bindParam(':url_prt', $Data['url_prt']);
            $stmt->execute();
            $portalId = $this->__connection->lastInsertId();
            
            $sql = 'INSERT INTO browser_portal(`id_brt`, `id_prt`, `rate`) VALUES';
            
            foreach($Data['BrowserRate'] as $brtId => $rate){
                $sql .= '('.$brtId.','.$portalId.','.$rate.'),';
            }
            
            $sql = rtrim($sql, ",");
            $stmt = $this->__connection->prepare($sql);
            $stmt->execute();
            
            //$this->__connection->commit();
            
            \vendor\Session::setFlashMessage('success_message' , 'Portal adaugat cu succes.');
            
        }
        catch(\Exception $e){
            //$this->__connection->rollback();
            throw new \Exception($e->getMessage());
        }
    }
    
    public function updatePortal($Data){
        
        
        exit('updating...');
    }
    
    /**
     * Valideaza datele pentru portal
     */
    private function validatePortal( $Data ){
        
        if(!isset($Data['name_prt']) || empty($Data['name_prt'])){
            throw new \Exception("Numele portalului nu poate fi gol.");
        }
        
        if(!isset($Data['url_prt']) || empty($Data['url_prt'])){
            throw new \Exception("Linkul portalului nu poate fi gol.");
        }
        
        if($this->getPortalByNameOrLink($Data['name_prt'] , $Data['url_prt'])){
            throw new \Exception("Numele portalului sau linkul acestuia exista deja.");
        }
        
        
    }
    
}

?>