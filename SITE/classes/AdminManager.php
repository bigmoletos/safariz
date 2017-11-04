 <?php

class AdminManager {

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

?>
