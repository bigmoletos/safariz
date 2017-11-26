<?php

/**
 * Description de gagnants
 * modif le 8/11
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
    //non utilisée, remplacée par la methode gagneperdu() dans la classe igmanager
    function addGagnant(Gagnants $gagnant) {
        try {

            $requete = $this->db->prepare('INSERT INTO gagnants (client_id, lot_id, id_dates_jeux ) ( SELECT clients.client_id, ig.ID, dates_jeux.id_dates_jeux FROM clients, ig, dates_jeux WHERE clients.client_id = :cid AND ig.id = :igid AND dates_jeux.id_dates_jeux = :id_dates_jeux) ');
            $requete->bindValue(':igid', $ID);
            $requete->bindValue(':cid', $clientid);
            $requete->bindValue(':id_dates_jeux', $id_dates_jeux);
            $requete->execute();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
//appel à d'autres classes
      function appelAutresClasses(){
        $donneeClient= new IgManager();
        
    }
    
    
    
    //méthode vérifiant que le joueur n'a pas deja gagné auquel cas il ne pourra plus gagner
    //notre parti pris est de le rediriger vers la page perdu afin d'augmenter les connexions
    //vérifie que client_id n'est pas deja dans la base
    public function pasDejaGagne($client_id) {
//        $sql = SELECT  mail, DATE(dateInscription) FROM clients WHERE mail='riz@yopmail.com'  AND DATE(dateInscription)='DATE(NOW())'; ou '20017-11-04'

//        $donneeClient = $this->GagnePerdu($clientid);
        //$clientid = $donneeClient['client_id'];
       // var_dump($clientid);
     //   var_dump($donneeClient);
        $requete = $this->db->prepare(" SELECT client_id  FROM gagnants WHERE client_id= :client_id ");
        $requete->bindValue(':client_id', $client_id);
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
     //   var_dump($result);
     //   $verif = count($result);
        $verif2 = $requete->rowCount();
          // var_dump($verif2);
        //  var_dump($verif);
        if ($verif2) {
           //  echo "vous avez  déjà gagné ";
//        if ($requete->rowCount()){     //compte le nbre de lignes  de date d'inscription correspondant  à la date du jour renvoyées par la requete, si aucune correspondance n'est  trouvée le client peut jouer
            return true;
        }
        //permet de fermer la requete
        $requete->closeCursor();
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

}

//fin classe