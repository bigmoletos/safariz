<?php
//cette classe permet de gerer les administrateurs
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
//            var_dump($req);
            echo "</pre>";
            if ($req->execute()) {
//                echo "<br/>nouvel administrateur correctement inséré<br/>";
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
    public function AdminControleLog(Admin $admin) {
        try {
            //on fait le prepare et on l'affecte à la variable $req
            //on affecte à la variable $req la valeur de l'objet $admin ($this->db) puis on prepare les données        
            //pour mettre les date en francais dans la requete INSERT INTO administrateur (nomAdm,  login, password, email, dateLastConnexion)
            //        VALUES ('fanny', 'fanny', 'fleur', 'fleur@free', 1510235228 )
            $this->db->query(" SET lc_time_names = 'fr_FR'");

            $req = $this->db->prepare('select login from administrateur WHERE login= :login');
            $req->bindValue(':login', $admin->getLogin());
            $req->execute();
//            var_dump($req);
            $nblog = $req->fetch(PDO::FETCH_ASSOC);
//            var_dump($nblog);
//            var_dump($admin);
//            SSSSSSSSSSSSSSS
            $verif = count($nblog);
      $verif2 = $req->rowCount();
//       var_dump($verif2);
//        var_dump($verif);
        if ($verif2) {
            // echo "vous avez  joué aujourd'hui";
//        if ($requete->rowCount()){     //compte le nbre de lignes  de date d'inscription correspondant  à la date du jour renvoyées par la requete, si aucune correspondance n'est  trouvée le client peut jouer
            return TRUE;
//            SSSSSSSSSSSSSSSSS
//            if ($nblog == TRUE) {
//            //    echo "<pre> Veuillez entrer un nouveau login</pre>";
//            } else {
//             //   echo "<pre> ce login n'existe pas</pre>";
//                var_dump($nblog);
//            //    echo "VALEUR DE nblog: $nblog ---";
//                $nblog = FALSE;
//                return $nblog;
          } else {
               return FALSE;
          }
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            ////pour afficher les erreurs on peut aussi tenter :
            die(print_r($this->db->errorInfo()));
            ////
        }
        $req->closeCursor();
    }

    //fonction permettant de verifier le login en cours de saisie dans le formulaire 
    //login en Ajax depuis la table administrateur
    public function verifLoginAjax(Admin $admin) {

        $req = $this->db->prepare("select login, from administrateur where login= :login ");
        $req->bindValue(':login', $admin->getLogin());
        $req->execute();
        var_dump($req);
        $tab = $req->fetchAll();
        $q = $_REQUEST["login"];
        var_dump($q);
        var_dump($tab);

        $indice = "";
        if ($q !== "") {
            $q = strtolower($q);
            var_dump($q);
            $len = strlen($q);
            var_dump($len);
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
        echo $indice === "" ? $indice : "ce login existe déjà veuillez en choisir un autre";
        return $indice;
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


//cette methode permet de verifier le lgin et mot de passe d'un client
    public function adminLogin(Admin $admin) {
      //  $result=array();
//        select mail, password FROM clients WHERE password='root' AND mail='riz@riz.r'
        $requete = $this->db->prepare('select  nomAdm, login, password FROM administrateur WHERE  email= :email ');
//        $requete->bindValue(':password', $client->getPassword());
        $requete->bindValue(':email', $admin->getEmail());
        $requete->execute();
  //     var_dump($requete).
    //   var_dump($client);
     $result = $requete->fetch(PDO::FETCH_ASSOC);
   //   $result = $requete->setFetchMode(PDO::FETCH_CLASS, 'Client');
    //   $result= $requete->fetchAll();
    //  var_dump($result);
     //   $verif2 = $requete->rowCount();
     //   var_dump($verif2);
    //    var_dump($result['password']);
        if ($result) {
          //  echo 'mot de passe trouvé <br>';
            return $result;
            $requete->closeCursor();
        }
//echo 'mot de passe non trouvé <br>';
        return FALSE;
        $requete->closeCursor();
    }


}
//fin classe
?>
