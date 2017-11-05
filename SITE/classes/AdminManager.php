 <?php

class AdminManager {

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
// $login,            $nomAdm,            $password;

public function addAdmin(Admin $admin) {
        try {
            //on fait le prepare et on l'affecte à la variable $req
            //on affecte à la variable $req la valeur de l'objet $admin ($this->db) puis on prepare les données        
            //pour mettre les date en francais dans la requete
            $this->db->query(" SET lc_time_names = 'fr_FR'");
            $req = $this->db->prepare('INSERT INTO administrateur (nomAdm,  login, password, email)'
                    . ' VALUES (:nomAdm, :login, :password, :email )');

            $req->bindValue(':nomAdm', $admin->getNomAdm());
            $req->bindValue(':login', $admin->getLogin());
            $req->bindValue(':password', $admin->getPassword());
             $req->bindValue(':email', $admin->getEmail());
            echo "<pre>";
            var_dump($req);
            echo "</pre>";
            if ($req->execute()) {
                echo "<br/>nouvel administrateur correctement inséré<br/>";
            }

            //version xxxxxx   
            //puis on fait l'execute     
            //insertion des données dans la base     
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            ////pour afficher les erreurs on peut aussi tenter :
            die(print_r( $this->db->errorInfo())); 
            ////
        }
    }

}
?>
