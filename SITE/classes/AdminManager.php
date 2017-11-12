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
            //pour mettre les date en francais dans la requete INSERT INTO administrateur (nomAdm,  login, password, email, dateLastConnexion)
            //        VALUES ('fanny', 'fanny', 'fleur', 'fleur@free', 1510235228 )
            $this->db->query(" SET lc_time_names = 'fr_FR'");
            $req = $this->db->prepare('INSERT INTO administrateur (nomAdm, login, password, email, dateLastConnexion)'
                    . ' VALUES (:nomAdm, :login, :password, :email, :dateLastConnexion )');

            $req->bindValue(':nomAdm', $admin->getNomAdm());
            $req->bindValue(':login', $admin->getLogin());
            $req->bindValue(':password', $admin->getPassword());
            $req->bindValue(':email', $admin->getEmail());
            $req->bindValue(':dateLastConnexion', $admin->getDateLastConnexion());
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
            die(print_r($this->db->errorInfo()));
            ////
        }
    }
//cette methode controle que le login n'existe pas deja dans la base de donnée
    public function addAdmincontrolelog(Admin $admin) {
        try {
            //on fait le prepare et on l'affecte à la variable $req
            //on affecte à la variable $req la valeur de l'objet $admin ($this->db) puis on prepare les données        
            //pour mettre les date en francais dans la requete INSERT INTO administrateur (nomAdm,  login, password, email, dateLastConnexion)
            //        VALUES ('fanny', 'fanny', 'fleur', 'fleur@free', 1510235228 )
            $this->db->query(" SET lc_time_names = 'fr_FR'");

            $req = $this->db->prepare('select login from administrateur WHERE login= :login');
            $req->bindValue(':login', $admin->getLogin());
            $req->execute();
            $nblog = $req->fetch(PDO::FETCH_ASSOC);
            $nb=count($nblog);
            var_dump($nb); 
            if($nb){
               echo "<pre> Veuillez entrer un nouveau login";
            
               var_dump($nb); 
            
            

//            
          

            //version xxxxxx   
            //puis on fait l'execute     
            //insertion des données dans la base     
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            ////pour afficher les erreurs on peut aussi tenter :
            die(print_r($this->db->errorInfo()));
            ////
        }
    }

    //fonction permettant de verifier le login en cours de saisie dans le formulaire 
    //login en Ajax depuis la table administrateur
    public function verifLogin(Admin $login) {

        $rep = $this->db->query("select login, from administrateur ");
        $tab = $req->fetchAll();
        $q = $_REQUEST["q"];
        $indice = "";
        if ($q !== "") {
            $q = strtolower($q);
            $len = strlen($q);
            foreach ($tab as $valeur) {
                if (stristr($q, substr($valeur[0], 0, $len))) {
                    if ($indice === "") {
                        $indice = $valeur[0];
                    } else {
                        $indice .= ", $valeur[0]";
                    }
                }
            }
        }
        echo $indice === "" ? "Pas de suggestion" : $indice;
    }

//fin fonction verif login
    //fonction permettant de  verifier password et login lors de la connexion 
    public function connectAdmin(Admin $admin) {

        $requete = $this->db->prepare('select login, password from administrateur where login= :login AND password= :password ');

        $requete->bindValue(':password', $admin->getPassword());
        $requete->bindValue(':login', $admin->getLogin());
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        var_dump($result);
        // $tab=array();
        //  $tab=count($result);
//               if (count($result)){
//                 echo 'login ok'; 
//                  header("Location: pageAdministrateur.php");
//             } else {
//                echo 'pas login ok' ;  
//             }
        // var_dump($tab); 
        return $result;
    }

//fin fonction connectAdmin
}

//fin classe
?>
