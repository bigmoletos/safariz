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

    // methode permettant de savoir si un client à gagné
    //compare la date de participation du client avec celle de l'IG en cours, si le lot est toujours en jeu (lotDispo=1)
    // le client gagne, ou si un autre lot est toujours en jeu.
    //Le client ayant gagné lotDispo passe à 0
    function GagnePerdu() {
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

            $requete = $this->db->prepare(" SELECT client_id, nom  FROM clients ");
            $requete->execute();
            
            $result = $requete->fetch(PDO::FETCH_ASSOC); //a modifier
          //  while($result){
          //        var_dump($result);
                  
          //  }
          

            //****************
            return $lot;
        } else {
            return false;
        }
       
        $requete->closeCursor(); //permet de fermer la requete
    }//fin gagneperdu

    //Todo : créer une méthode qui récupère les infos du lot (label + description) va utiliser la table lot en utilisant ID de la table ig
}//fin classe

?>
