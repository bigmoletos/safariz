<?php

/**
 * Description de gagnants
 *
 * @author JCM
 */

class gagnantsManager {
    
      //attribut
    private $db;

    //methode constructeur
    //on met (PDO $db) car on a besoin d'un objet pdo car le new=PDO(......) du connexion fait un objet PDO
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // methode getter
    public function getDb() {
        return $this->getdb;
    }

    //methode setter
    public function setDb($db) {
        $this->db = $db;
    }

    
    
    
    
    
    
    
    function suiviGagnant() { // fonction de suivi des gagnants de lots
         
        
    }
}//fin classe