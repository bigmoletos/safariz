<?php

/**
 * Description de gagnants
 *modif le 8/11
 * @author fd
 */

class gagnantsManager {
    
      //attribut
    private $db;

    //methode constructeur
    //on met (PDO $db) car on a besoin d'un objet pdo car le new=PDO(......) du connexion fait un objet PDO
    public function __construct(PDO $db) {
        $this->db = $db;
    }

  
    //fonction permettant d'inserer un nouveau gagnant dans la table gagnant
    function addGagnant(Gagnants $gagnant){
       try {
        
        
        $req = $this->db->prepare('INSERT INTO gagnants (client_id, dateGain, lot_id )'
                    . ' VALUES ( )');

        
        
        $req->execute();
         } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        
    }
    
    
    
    
    
//    // methode permettant de savoir si un client à gagné
//    //compare la date de participation du client avec celle de l'IG en cours, si le lot est toujours en jeu (lotDispo=1) le client gagne, ou si un autre lot est toujours en jeu.
//    //Le client ayant gagné lotDispo passe à 0
//    function GagnePerdu(Gagnants $gagnant){
//        $requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM gagnants WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())") ;
//        $requete->bindValue(':adresse', $client->getAdresse());
//        $requete->bindValue(':cp', $client->getCp());
//        $requete->bindValue(':ville', $client->getVille());
//        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
//        $requete->execute();
//        $result = $requete->fetch(PDO::FETCH_ASSOC);
////        var_dump($result);
//        if (count($result)){
////        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
//            return true; 
//        }
//        //permet de fermer la requete
//        $requete->closeCursor();
//    
    
    
    function suiviGagnant() { // fonction de suivi des gagnants de lots
         
        
    }
}//fin classe