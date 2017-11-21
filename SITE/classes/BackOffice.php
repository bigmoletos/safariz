<?php
//cette classe permet de gerer la partie back-Office du site 
//Suivre en direct l’évolution des IG : nombre total, nombre restant, nombre de participants, nombre de gagnants


class BackOffice{

private $db;

//methode constructeur
//on met (PDO $db) car on a besoin d'un objet pdo car le new=PDO(......) du connexion fait un objet PDO
public function __construct(PDO $db) {
$this->db = $db;
}

//methode extraction nbre de gagnants
   function nbGagnants(){
  $requete = $this->db->prepare(" SELECT * FROM ig WHERE lotDispo= '1' and DATE(datetime)<=DATE(NOW())");
        //$requete->bindValue(':adresse', $client->getAdresse());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
     //   var_dump($result);
        $verif = count($result);
        $verif2 = $requete->rowCount();
    //    var_dump($verif2);
     //   var_dump($verif);
//        var_dump($result);
//Todo : gerer les differents lots pour une mm date
//        suite au var_dump($result) on constate qu'il prend le premier lot à gagner dans la liste'
        if ($verif) {
//        if ($requete->rowCount()){ //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            //lotDispo=0;
            $ID = $result['ID'];
            $lot = $result['label'];
            // var_dump($lot);
            // var_dump($ID);
            // echo" ID du lot :$ID vous avez gagné le lot: $lot";
            //echo"$lot";
            // méthode qui update un IG pour passer lotDispo à 0      
            $requete = $this->db->prepare(" UPDATE ig SET lotDispo= '0' WHERE ID= :ID");
            $requete->bindValue(':ID', $ID);
            $requete->execute();
            return $lot;
        } else {
            return false;
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }


//methode extraction nbre de participants
  function nbParticipant(){
$requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM clients WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())") ;
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':cp', $client->getCp());
        $requete->bindValue(':ville', $client->getVille());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        

//        var_dump($result);
        if (count($result)){
//        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            return true; 
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }


//methode extraction nbre lots gagnés
  function nbLotGagne(){
$requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM clients WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())") ;
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':cp', $client->getCp());
        $requete->bindValue(':ville', $client->getVille());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        

//        var_dump($result);
        if (count($result)){
//        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            return true; 
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }

    
    

//methode extraction nbre lots restants
    //inutile une simple soustractyion suffira
  function nbLotRestant(){
$requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM clients WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())") ;
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':cp', $client->getCp());
        $requete->bindValue(':ville', $client->getVille());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        

//        var_dump($result);
        if (count($result)){
//        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            return true; 
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }
    
    
    
    
    
//methode extraction nbre d'ig
  function nbIg(){
$requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM clients WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())") ;
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':cp', $client->getCp());
        $requete->bindValue(':ville', $client->getVille());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        

//        var_dump($result);
        if (count($result)){
//        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            return true; 
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }
    
    
    
    
}//fin classe
?>
 