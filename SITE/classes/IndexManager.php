  <?php

class indexAdmin {

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
  

public function verifJeux(AdminJeu $jeu) {
        try {
            //on fait le prepare et on l'affecte à la variable $req
            //on affecte à la variable $req la valeur de l'objet $admin ($this->db) puis on prepare les données        
            //pour mettre les date en francais dans la requete
            $this->db->query(" SET lc_time_names = 'fr_FR'");
            $req = $this->db->prepare('select INTO dates_jeux (date_debut_jeu,  date_fin_jeu)'
                    . ' VALUES (:date_debut_jeu, :date_fin_jeu )');

            $req->bindValue(':date_debut_jeu', $jeu->getdate_debut_jeu());
            $req->bindValue(':date_fin_jeu', $jeu->getdate_fin_jeu());
            
            echo "<pre>";
          //  var_dump($req);
            echo "</pre>";
            if ($req->execute()) {
                echo "<br/>nouvelles dates correctement ins�r�es en bdd<br/>";
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

    //fonction permettant de verifier le login en cours de saisie dans le formulaire 
    //login en Ajax depuis la table administrateur
    
    
    
    
    
    
    
    
    
    
    
}//fin classe
?>
