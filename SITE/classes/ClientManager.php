<?php

//classe repercutant les actions de la classe client dans la base de données
//modif le 8/11/17
class ClientManager {

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

    // méthode add() pour ajouter des enregistrements en base de données (insert)
    //fonction faisant appel à la classe Client, avec un objet $client
    //on passe l'objet client car c'est celui quon passe dans le bdr
    public function addClient(Client $client) {
        try {
            //pour mettre les date en francais dans la requete
            $this->db->query(" SET lc_time_names = 'fr_FR'");
            //$req = $this->db->prepare("INSERT INTO clients (nom,  prenom, mail, adresse, cp, ville, tel, session_id, newsLetterInscription )"
            //     . " VALUES (:nom, :prenom, :mail, :adresse, :cp, :ville, :tel, :session_Id, :newsLetterInscription ");
            $req = $this->db->prepare('INSERT INTO clients (nom,  prenom, mail, adresse, cp, ville, tel, session_id ,ip, password, newsLetterInscription )'
                    . ' VALUES (:nom, :prenom, :mail, :adresse, :cp, :ville, :tel, :session_id,:ip , :password, :newsLetterInscription )');

// champs base de donnée client_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,newsLetterInscription
//    champs formulaire  nom  prenom mail adresse  ville cp   majeur reglement  newsletter
            //version bindValue et non array car on melange des chaines de caracteres avec des entiers

            $req->bindValue(':nom', $client->getNom());
            $req->bindValue(':prenom', $client->getPrenom());
            $req->bindValue(':mail', $client->getMail());
            $req->bindValue(':adresse', $client->getAdresse());
            $req->bindValue(':cp', $client->getCp());
            $req->bindValue(':ville', $client->getVille());
            $req->bindValue(':tel', $client->getTel());
            $req->bindValue(':session_id', $client->getSession_Id());
            $req->bindValue(':ip', $client->getIp());
            $req->bindValue(':password', $client->getPassword());
            $req->bindValue(':newsLetterInscription', $client->getNewsLetterInscription());
            echo "<pre>";
// var_dump($req);
            echo "</pre>";
            if ($req->execute()) {
                //  echo "<br/>nouveau client correctement inséré<br/>";
                return $this->db->lastInsertId();
            } else {
                return false;
            }

            //puis on fait l'execute     
            //insertion des données dans la base     
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

//**************************************************
    //cette methode permet de verifier le lgin et mot de passe d'un client
    public function clientLogin(Client $client) {
        //  $result=array();
//        select mail, password FROM clients WHERE password='root' AND mail='riz@riz.r'
        $requete = $this->db->prepare('select client_id, nom,  prenom, mail, adresse, cp, ville, tel,  password, newsLetterInscription  FROM clients WHERE  mail= :mail ');
//        $requete->bindValue(':password', $client->getPassword());
        $requete->bindValue(':mail', $client->getMail());
//        $req->bindValue(':session_id', $client->getSession_Id());
//        $req->bindValue(':ip', $client->getIp());
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

//**************************************************
    //**************************************************   
    // méthode update() pour pouvoir modifier des enregistrements en base de données
    //(update) à faire sur les 3 champs, inutile de verifier
    protected function update(Client $client) {
        //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $requete = $this->db->prepare('UPDATE clients SET password WHERE password= :password AND client_id = :client_id');
        $requete->bindValue(':password', $client->password());
        $requete->bindValue(':client_id', $client->client_id());
        $requete->execute();
    }

    
    //**************************************************   
    // méthode delete() pour pouvoir supprimer des enregistrements de la base de données
//    public function delete($id) {
//        $this->db->exec('DELETE FROM client WHERE id = ' . (int) $id);
//    }
//**************************************************
    // méthode save() permettant de vérifier une client isValid(), et si elle est isNew(),
    //pus l’ajoute avec addclient(), sinon la modifier avec update()
//    public function save(Client $client) {
//        if ($client->isValid()) {
//            $client->isNew() ? $this->addClient($client) : $this->update($client);
//        } else {
//            throw new Exception('La client doit être valide pour être enregistrée');
//        }
//    }
    // méthode liste() pour charger les N dernieres client les plus 
    // recentes (select) N est un parametre à passer à liste ($n), mettre une limite (SELECT * FROM ma_table LIMIT 100;)
    //methode getlist
    public function getList($debut = null, $limite = null) {
        //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $sql = 'SELECT id, auteur, titre, contenu, date_ajout, date_modif, image FROM client ORDER BY id DESC';

        // On vérifie l'intégrité des paramètres fournis.
        if (!is_null($debut) || !is_null($limite)) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }
        $requete = $this->db->query($sql);
        //avec un while on aurait mit un FETCH_ASSOC
        $requete->setFetchMode(PDO::FETCH_CLASS, 'Client');
        $listeClient = $requete->fetchAll();
        // On parcourt notre liste de client pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
        foreach ($listeClient as $client) {
            $client->setDate_ajout(new DateTime($client->getDate_ajout()));
            $client->setDate_modif(new DateTime($client->getDate_modif()));
        }
        //permet de fermer la requete
        // var_dump($listeClient);
        $requete->closeCursor();

        return $listeClient;
    }

//******************************************************************************
    //va chercher la date d'inscription en fonction du mail et la compare à la date du jour
//    si cette date est inconnue (FALSE), alors le client peut jouer ce jour. On identifie un client par son mail, que l'on considére comme unique
    public function ClientPeutJouerCejour(Client $client) {
//        $sql = SELECT  mail, DATE(dateInscription) FROM clients WHERE mail='riz@yopmail.com'  AND DATE(dateInscription)='DATE(NOW())'; ou '20017-11-04'

        $requete = $this->db->prepare(" SELECT mail, DATE(dateInscription) FROM clients WHERE mail= :mail  AND DATE(dateInscription)= DATE(NOW())");
        $requete->bindValue(':mail', $client->getMail());
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        $verif = count($result);
        $verif2 = $requete->rowCount();
        //   var_dump($verif2);
        //   var_dump($verif);
        if ($verif2) {
            // echo "vous avez  joué aujourd'hui";
//        if ($requete->rowCount()){     //compte le nbre de lignes  de date d'inscription correspondant  à la date du jour renvoyées par la requete, si aucune correspondance n'est  trouvée le client peut jouer
            return true;
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }

    //methode count permet de compter le nombre de client dans la bdr
//    public function count() {
//        $count = $this->db->query('SELECT COUNT(*) FROM client');
//        return $count->fetchColumn();
//    }
//*****************************************************************************
//requete pour foyer unique, un seul foyer peut gagner un lot, on determine cette condition
// en considérant que seule l'adresse permet d'identifier un foyer. Un foyer pouvant jouer chaque jour le foyer sera valide s'il est unique
// et s'il n'a pas deja joué ce jour.
//SELECT   `adresse`, `cp`, `ville`, DATE(dateInscription)  FROM clients WHERE adresse='1 avenue du riz rouge' and cp='13045' AND ville='SAINTE MARIE DE LA MER' AND DATE(dateInscription)='2017-11-04'

    public function foyerUnique(Client $client) {

        $requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM clients WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())");
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':cp', $client->getCp());
        $requete->bindValue(':ville', $client->getVille());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
//        var_dump($result);
        if (count($result)) {
//        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            return true;
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }

    //methode count permet de compter le nombre de client dans la bdr
//    public function count() {
//        $count = $this->db->query('SELECT COUNT(*) FROM client');
//        return $count->fetchColumn();
//    } 
    //    //**************************************************    
    //methode permettant la gestion des images
    //Premiere partie tu récupère le nom de l'image :
//        $image = basename($_FILES['image']['name']);
    //Ensuite tu fais ton système d'upload
//Tu vérifie d'abord, si c'est bien une image comme suis :
//                    *************************
//                $dossier = '/nom du dossier';<br> $extensions = array('.png', '.gif', '.jpg', '.jpeg');
//             $extension = strrchr($_FILES['image']['name'], '.');
//             //Tu fais les vérifications nécéssaires
//             if(!in_array($extension, $extensions))
//              //Si l'extension n'est pas dans le tableau
//             {
//                  $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
//             }
//             //S'il n'y a pas d'erreur
//             if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
//             {
//                  //On formate le nom du fichier ici...
//                  $fichier = strtr($fichier,
//                       'À�?ÂÃÄÅÇÈÉÊËÌ�?Î�?ÒÓÔÕÖÙÚÛÜ�?àáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
//                       'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
//                  $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
//                  if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier))
//              //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
//                  {
//             //La tu insère le nom du fichier dans ta table
//             $req = $bdd->prepare('INSERT INTO nom_table(image) VALUES(:image)'); // Evidemment il faut mettre un WHERE .. = .. (car l'image est forcément liée à un utilisateur?)
//             $req->execute(array($fichier));
//             $req->closeCursor();
//              else
//              //Sinon (la fonction renvoie FALSE.
//                  {
//
//                       echo 'Echec de l\'upload !';
//                  }
//             }
//             else
//             {
//                  echo $erreur;
//             }
//
//              *****************************
    //Dans une autre page :
    //
//                     session_start();
    /*
      Partons sur le fait que l'ID de l'utilisateur qui upload
     *  l'image possède son ID dans une variable de SESSION récupérée lors de la connexion
     */

    //Tu récupère donc le nom de l'image
//                     $req = $bdd->prepare('SELECT image FROM nom_table WHERE id=?');
//                     $req->execute(array($_SESSION['id_user']));
//                     $donnees = $req->fetch();
    //Ensuite tu peux afficher l'image comme ceci

    /*     * *  <img src="nom du dossier/ <?php echo $donnees['image']; ?> "/>** */
//
    //Et ton image sera alors affichée.
    //**************************************************   
//methode permetttant de verifier le login utilisateur à la bdr
//  verif login
//  
//    $pseudo_Exist = $bd->prepare("SELECT pseudo FROM client WHERE pseudo = :pseudo");
//        //On recupère les pseudo de la base ou les pseudo sont egaux au pseudo passé par le formulaire
//    $pseudo_Exist->bindValue('pseudo', $pseudo, PDO::PARAM_STR);
//    $pseudo_Exist->execute();
//    //on exécute la requête
// 
//    //$pseudoINbdd = $pseudo_Exist->rowCount(); //pb de portabilite avec row count
//        $pseudoINbdd = $pseudo_Exist->Count(fetchColumn());
//
//
//    //Rowcount permet de sortir le nombre de valeur que t'as requête renvoi, que l'on rentre dans la variable pseudoINbdd (ou autre )
// 
//    if($pseudoINbdd == 0){
//        //Si la requête renvoi 0, le pseudo n'existe pas dans la base, sinon le pseudo existe.
//    
//
}
