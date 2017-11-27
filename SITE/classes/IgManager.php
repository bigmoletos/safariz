<?php

class IgManager {

    /**
     * Attribut contenant l'instance reprÃ©sentant la BDD.
     * @type PDO
     */
    private $db;

    /**
     * Constructeur  chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     * @param $db PDO Le DAO
     * @return void
     */
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    //methode permettant d'obtenir l'id_dates_jeux dans la table dates_jeux
    function GetCurrentIG() {
        $requete = $this->db->prepare("SELECT id_dates_jeux FROM dates_jeux WHERE now() BETWEEN `date_debut_jeu` AND `date_fin_jeu`");
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        $id_dates_jeux = $result['id_dates_jeux'];
        //    var_dump($id_dates_jeux);
        //   var_dump($result);

        return $id_dates_jeux;
    }

    // methode permettant de savoir si un client à gagné
    //compare la date de participation du client avec celle de l'IG en cours, si le lot est toujours en jeu (lotDispo=1)
    // le client gagne, ou si un autre lot est toujours en jeu.
    //Le client ayant gagné lotDispo passe à 0
    function GagnePerdu($client_id) {
        $id_dates_jeux = $this->GetCurrentIG();
//        var_dump($id_dates_jeux);
        $requete = $this->db->prepare(" SELECT * FROM ig WHERE lotDispo= '1' and DATE(datetime)<=DATE(NOW())");
        //$requete->bindValue(':adresse', $client->getAdresse());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
           var_dump($result);
        $verif = count($result);
        $verif2 = $requete->rowCount();
//Todo : gerer les differents lots pour une mm date
//        suite au var_dump($result) on constate qu'il prend le premier lot à gagner dans la liste'
        if ($verif) {
//        if ($requete->rowCount()){ //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            //lotDispo=0;
            $ID = $result['ID'];
            $lot = $result['label'];
            $donneeClient = array();
            $donneeClient['ID'] = $ID;
            $donneeClient['lot'] = $lot;
            $donneeClient['client_id'] = $client_id;
            var_dump($donneeClient);
            // var_dump($lot);
            // var_dump($ID);
            // echo" ID du lot :$ID vous avez gagné le lot: $lot";
            //echo"$lot";
            // méthode qui update un IG pour passer lotDispo à 0      
            $requete = $this->db->prepare(" UPDATE ig SET lotDispo= '0' WHERE ID= :ID");
            $requete->bindValue(':ID', $ID);
            $requete->execute();
            //******************
            //methode permettant de sotcker dans la table gagnants le client_id, le lotID(ouID de ig), la date du gain
            //   var_dump($ID);
            //  var_dump($client_id);

            $requete = $this->db->prepare('INSERT INTO gagnants (client_id, lot_id, id_dates_jeux ) ( SELECT clients.client_id, ig.ID, dates_jeux.id_dates_jeux FROM clients, ig, dates_jeux WHERE clients.client_id = :cid AND ig.id = :igid AND dates_jeux.id_dates_jeux = :id_dates_jeux) ');
            $requete->bindValue(':igid', $ID);
            $requete->bindValue(':cid', $client_id);
            $requete->bindValue(':id_dates_jeux', $id_dates_jeux);
            $requete->execute();
            var_dump($requete);
            // $result = $requete->fetch(PDO::FETCH_ASSOC); //a modifier
            //  while($result){
             var_dump($result);
            //  }
            //****************
            return $donneeClient;
//            return $lot;
        } else {
            return false;
        }

        $requete->closeCursor(); //permet de fermer la requete
    }

//fin gagneperdu

    function enregistreGagnant($client_id) {
        //methode permettant de sotcker dans la table gagnants le client_id, le lotID(ouID de ig), la date du gain
        
        $id_dates_jeux = $this->GetCurrentIG();
        var_dump($id_dates_jeux);
        
        $donneeClient = $this->GagnePerdu($client_id);
        $ID = $donneeClient['ID'];
        var_dump($ID);
        
        $client_id=$donneeClient['client_id'];
//        $client_id = $this->GagnePerdu($client_id);
        var_dump($client_id);

        $requete = $this->db->prepare('INSERT INTO gagnants (client_id, lot_id, id_dates_jeux ) ( SELECT clients.client_id, ig.ID, dates_jeux.id_dates_jeux FROM clients, ig, dates_jeux WHERE clients.client_id = :cid AND ig.id = :igid AND dates_jeux.id_dates_jeux = :id_dates_jeux) ');
        $requete->bindValue(':igid', $ID);
        $requete->bindValue(':cid', $client_id);
        $requete->bindValue(':id_dates_jeux', $id_dates_jeux);
        $requete->execute();
    }

    function appelAutresClasses(){
        require ('gagnantsManager.php');
        $pasDejaGagne= new gagnantsManager();
    }
    
    
    function GagnePerduBis($client_id) {
        $id_dates_jeux = $this->GetCurrentIG();
        $requete = $this->db->prepare(" SELECT * FROM ig WHERE lotDispo= '1' and DATE(datetime)<=DATE(NOW())");
        //$requete->bindValue(':adresse', $client->getAdresse());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        //   var_dump($result);
        $verif = count($result);
        $verif2 = $requete->rowCount();
//Todo : gerer les differents lots pour une mm date
//        suite au var_dump($result) on constate qu'il prend le premier lot à gagner dans la liste'
        if ($verif) {
//        if ($requete->rowCount()){ //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            //lotDispo=0;
            $ID = $result['ID'];
            $lot = $result['label'];
             $donneeClient = array();
            $donneeClient['ID'] = $ID;
            $donneeClient['lot'] = $lot;
            $donneeClient['client_id'] = $client_id;
            var_dump($donneeClient);
            // var_dump($lot);
            // var_dump($ID);
            // echo" ID du lot :$ID vous avez gagné le lot: $lot";
            //echo"$lot";
            // méthode qui update un IG pour passer lotDispo à 0      
            $requete = $this->db->prepare(" UPDATE ig SET lotDispo= '0' WHERE ID= :ID");
            $requete->bindValue(':ID', $ID);
            $requete->execute();
            //******************
            //appel à la methode Gagnantunique de la classe gagnantsManager
           // $gagnantUnique=new gagnantsManager();
           $pasDejaGagne= gagnantsManager::class;
           
          //lance la methode enregistre un gagnant de la classe gagnantsManager
           $enregistre=$this->enregistreGagnant($client_id);
           var_dump($enregistre);
           
            //methode permettant de sotcker dans la table gagnants le client_id, le lotID(ouID de ig), la date du gain

//            $requete = $this->db->prepare('INSERT INTO gagnants (client_id, lot_id, id_dates_jeux ) ( SELECT clients.client_id, ig.ID, dates_jeux.id_dates_jeux FROM clients, ig, dates_jeux WHERE clients.client_id = :cid AND ig.id = :igid AND dates_jeux.id_dates_jeux = :id_dates_jeux) ');
//            $requete->bindValue(':igid', $ID);
//            $requete->bindValue(':cid', $client_id);
//            $requete->bindValue(':id_dates_jeux', $id_dates_jeux);
//            $requete->execute();

            // $result = $requete->fetch(PDO::FETCH_ASSOC); //a modifier
            //  while($result){
            var_dump($result);

            //  }
            //****************
            return $lot;
        } else {
            return false;
        }

        $requete->closeCursor(); //permet de fermer la requete
    }

//fin gagneperdu
    //Todo : créer une méthode qui récupère les infos du lot (label + description) va utiliser la table lot en utilisant ID de la table ig
}

//fin classe
?>
