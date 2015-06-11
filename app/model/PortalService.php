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
        $sql = "SELECT * FROM portals_prt
                
        ";
        $stmt = $this->__connection->prepare($sql);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        return $return;
    }
    public function getAllPortalsByBrowser($BrowserId){
        $sql = "SELECT * FROM portals_prt pp
                JOIN browser_portal as bp ON (bp.id_prt = pp.id_prt)
                WHERE bp.id_brt = :id_brt
        ";
        $stmt = $this->__connection->prepare($sql);
        $stmt->bindValue(':id_brt' , $BrowserId);
        $stmt->execute();
        $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $return;
    }
    /**
     *  Intoarce un portal dupa Id. 
     */
    public function getPortalById($Id){
        
        $sql = "SELECT pp.*, bp.rate , btb.* FROM `portals_prt` as pp
                LEFT JOIN browser_portal as bp ON (bp.id_prt = pp.id_prt)
                LEFT JOIN browser_types_brt btb ON (btb.id_brt = bp.id_brt)
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
            if(isset($dataset['id_brt'])){
                $brs = new \app\entity\Browser();
                $brs->exchange($dataset);
                $brs->setRate($dataset['rate']);
                $rates[$brs->getIdBrt()] = $brs;
                unset($brs);
            }
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
    
    /**
     * Update portal data
     */
    public function updatePortal($Data){
        //Update portal
        try 
        {
            $sql = "UPDATE `portals_prt` pp 
                SET pp.`name_prt`= :name_prt, 
                    pp.`url_prt`=:url_prt 
                WHERE pp.id_prt = :id_prt";
            $stmt = $this->__connection->prepare($sql);
            $stmt->bindParam(':name_prt', $Data['name_prt']);
            $stmt->bindParam(':url_prt', $Data['url_prt']);
            $stmt->bindParam(':id_prt', $Data['id_prt']);
            $stmt->execute();
             
            foreach($Data['BrowserRate'] as $id_brt => $rate ) {
                //verificare existenta rate.
                if($this->getPortalToBrowser( $Data['id_prt'] , $id_brt)){
                    $sql = "UPDATE `browser_portal` bp SET bp.`rate`= :rate
                        WHERE id_prt = :id_prt AND id_brt = :id_brt";
                    $stmt = $this->__connection->prepare($sql);
                    $stmt->bindParam(':rate', $rate);
                    $stmt->bindParam(':id_prt', $Data['id_prt']);
                    $stmt->bindParam(':id_brt', $id_brt);
                    $stmt->execute();    
                } else {
                    //Facem insert
                    $sql = "INSERT INTO browser_portal(id_brt , id_prt , rate) VALUES (:id_brt , :id_prt , :rate); ";
                    $stmt = $this->__connection->prepare($sql);
                    $stmt->bindParam(':rate', $rate);
                    $stmt->bindParam(':id_prt', $Data['id_prt']);
                    $stmt->bindParam(':id_brt', $id_brt);
                    $stmt->execute();
                }
            }
            \vendor\Session::setFlashMessage('success_message' , 'Portal salvat cu succes.');
        }
        catch ( \Exception $e) 
        {
            throw new \Exception($e->getMessage());   
        }
    }
    
    /**
     *  Sterge un portal.
     */
    public function remove($PortalId){
        try
        {
            $sql = "DELETE FROM `portals_prt` WHERE id_prt = :id";
            $stmt = $this->__connection->prepare($sql);
            $stmt->bindParam(':id', $PortalId);
            $stmt->execute();
            \vendor\Session::setFlashMessage('success_message' , 'Portal sters cu succes.');
        }
        catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());   
        }
    }
    
    /**
     *  Verifica daca exista relatie intre portal si browser. 
     */
    private function getPortalToBrowser($IdPortal , $IdBrowser) {
        
        $sql = "SELECT bp.id_prt FROM browser_portal bp
                WHERE bp.id_prt = :id_prt AND bp.id_brt = :id_brt
            ";
            $stmt = $this->__connection->prepare($sql);
            $stmt->bindParam(':id_prt', $IdPortal);
            $stmt->bindParam(':id_brt', $IdBrowser);
            $stmt->execute();
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            if(empty($return)) {
                return false;   
            } else {
                return true;
            }
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