 <?php

class IgManager {

    /**
     * Attribut contenant l'instance reprÃ©sentant la BDD.
     * @type PDO
     */
    private $db;

    /**
     * Constructeur Ã©tant chargÃ© d'enregistrer l'instance de PDO dans l'attribut $db.
     * @param $db PDO Le DAO
     * @return void
     */
    public function __construct(PDO $db) {
        $this->db = $db;
    }
}



    // methode permettant de savoir si un client à gagné
    //compare la date de participation du client avec celle de l'IG en cours, si le lot est toujours en jeu (lotDispo=1) le client gagne, ou si un autre lot est toujours en jeu.
    //Le client ayant gagné lotDispo passe à 0
    function GagnePerdu(Ig $ig){
        $requete = $this->db->prepare(" SELECT label, ID, lotDispo, DATE(datetime)  FROM ig WHERE lotDispo= '1' and DATE(datetime)>=DATE(NOW())") ;
        $requete->bindValue(':adresse', $client->getAdresse());
        
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
    



?>
