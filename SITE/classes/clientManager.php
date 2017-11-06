<?php

//classe repercutant les actions de la classe client dans la base de données

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

    //methode connexion
//      function connexion($login) {
//    $requete = 'SELECT * FROM personnes WHERE login = "'.$login.'"';
////    global $bd;
//    $resultat = $bd->query($requete);
//     
//      }
//      
//  *******************************************
//    version  de la correction 
//     protected function add(News $news) {
//        $requete = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif, image)'
//                . 'VALUES(:auteur, :titre, :contenu, NOW(), NOW(), :image)');
//        $requete->bindValue(':titre', $news->titre());
//        $requete->bindValue(':auteur', $news->auteur());
//        $requete->bindValue(':contenu', $news->contenu());
//       $requete->bindValue(':image', $news->image());
//        $requete->execute();
//    }
    // méthode add() pour ajouter des enregistrements en base de données (insert)
    //fonction faisant appel à la classe Client, avec un objet $client
    //on passe l'objet client car c'est celui quon passe dans le bdr
    public function addClient(Client $client) {
        try {
            //on fait le prepare et on l'affecte à la variable $req
            //on affecte à la variable $req la valeur de l'objet $client ($this->db) puis on prepare les données        
//                $req =$this->db->prepare('
//                    select * 
//                    from Client 
//                    where 
//                    and titre = :titre 
//                    and auteur = :auteur 
//                    and contenu = :contenu 
//                    and date_ajout = :date_ajout');
            //pour mettre les date en francais dans la requete
            $this->db->query(" SET lc_time_names = 'fr_FR'");
            //$req = $this->db->prepare("INSERT INTO clients (nom,  prenom, mail, adresse, cp, ville, tel, session_id, newsLetterInscription )"
            //     . " VALUES (:nom, :prenom, :mail, :adresse, :cp, :ville, :tel, :session_Id, :newsLetterInscription ");
            $req = $this->db->prepare('INSERT INTO clients (nom,  prenom, mail, adresse, cp, ville, tel, session_id,ip, newsLetterInscription )'
                    . ' VALUES (:nom, :prenom, :mail, :adresse, :cp, :ville, :tel, :session_Id,:ip , :newsLetterInscription )');

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
            $req->bindValue(':session_Id', $client->getSession_Id());
            $req->bindValue(':ip', $client->getIp());
            $req->bindValue(':newsLetterInscription', $client->getNewsLetterInscription());
            echo "<pre>";
//            var_dump($req);
            echo "</pre>";
            if ($req->execute()) {
                echo "<br/>nouveau client correctement inséré<br/>";
            }

            //version xxxxxx   
            //puis on fait l'execute     
            //insertion des données dans la base     
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

//********************
    //version david du add
//    public function add2($tablo) {
//        try { $req = $this->db->prepare(""
//                . "INSERT INTO client(titre, auteur, contenu,date_ajout, date_modif ) "
//                . "VALUES (?, ?, ?,?, ?)");
//       //on execute dans un tableau
//            $req->execute(array(
//                $tablo['titre'],
//                $tablo['auteur'],
//                $tablo['contenu'],
//                $tablo['date_ajout'],
//                $tablo['date_modif'], ));
//       
//        echo "l'insertion s'est magnifiquement bien passée";
//             } catch (Exception $e) { echo $e->getMessage();
//            } 
//        
//        }
//    **********************
//**************************************************
    // méthode load() pour pouvoir charger un enregistrement specifique depuis la base de données
    //(select) à partir d'un id
    //id etant un entier et  non un objet (contrairement à $client) il est faux de le mettre en attribut de classe (client $id)
//    //    public function Load($id) {
//        $req=$this->db->prepare('SELECT * FROM client WHERE id=$id ');
//        //on indique que l'on utilise les reusltats en tant que classe en faisant appel à la classe client
//       
//               
//               
//        
//        $req->setFetchMode (PDO::FETCH_CLASS, 'client');
//       //on execute la requete
//        $resultat=$req->execute();
//        //on retourne la ligne par fetch()
//        return $resultat->fetch();       
//    }
//version david
    public function load($id) {
        //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, date_ajout, date_modif, image FROM client WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS, 'Client');
        $client = $requete->fetch();
        $client->setDate_ajout(new DateTime($client->getDate_ajout()));
        $client->setDate_modif(new DateTime($client->getDate_modif()));
//        var_dump($client);
        return $client;
    }

//**************************************************
    //**************************************************   
    // méthode update() pour pouvoir modifier des enregistrements en base de données
    //(update) à faire sur les 3 champs, inutile de verifier
    protected function update(Client $client) {
        //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $requete = $this->db->prepare('UPDATE clients SET'
                . ' auteur = :auteur, titre = :titre, contenu = :contenu, date_modif = NOW(), image = :image '
                . 'WHERE id = :id');
        $requete->bindValue(':titre', $client->titre());
        $requete->bindValue(':auteur', $client->auteur());
        $requete->bindValue(':contenu', $client->contenu());
        $requete->bindValue(':image', $client->image());
        $requete->bindValue(':id', $client->id(), PDO::PARAM_INT);
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
//    si cette date est inconnue (FALSE), alors le client peut jouer ce jour
    public function ClientPeutJouerCejour(Client $client) {
//        $sql = SELECT  mail, DATE(dateInscription) FROM clients WHERE mail='riz@yopmail.com'  AND DATE(dateInscription)='DATE(NOW())'; ou '20017-11-04'

        $requete = $this->db->prepare(" SELECT mail, DATE(dateInscription) FROM clients WHERE mail= :mail  AND DATE(dateInscription)= DATE(NOW())");
        $requete->bindValue(':mail', $client->getMail());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
//        var_dump($result);
        if (count($result)>=0){
//        if ($requete->rowCount()){     //compte le nbre de lignes renvoyées par la requete, si aucune ligne le client peut jouer
            return false; 
        }
        //permet de fermer la requete
        $requete->closeCursor();
    }

    //methode count permet de compter le nombre de client dans la bdr
    public function count() {
        $count = $this->db->query('SELECT COUNT(*) FROM client');
        return $count->fetchColumn();
    }
//*****************************************************************************
//requete pour foyer unique, un seul foyer peut gagner un lot, on determine cette condition
// en considérant que seule l'adresse permet d'identifier un foyer
//SELECT   `adresse`, `cp`, `ville`, DATE(dateInscription)  FROM clients WHERE adresse='1 avenue du riz rouge' and cp='13045' AND ville='SAINTE MARIE DE LA MER' AND DATE(dateInscription)='2017-11-04'
   
      public function foyerUnique(Client $client) {

        $requete = $this->db->prepare(" SELECT adresse, cp, ville, DATE(dateInscription)  FROM clients WHERE adresse= :adresse and cp= :cp AND ville= :ville AND DATE(dateInscription)=DATE(NOW())") ;
        $requete->bindValue(':adresse', $client->getAdresse());
        $requete->bindValue(':cp', $client->getCp());
        $requete->bindValue(':ville', $client->getVille());
        //$requete->bindValue(':dateInscription', date("Y-m-d"));  //$client->dateInscription() //attention le DATE(NOW()) pourrait ne pas compatible avec toutes les bases
        $requete->execute();
        $result = $requete->fetch(PDO::FETCH_ASSOC);
//        var_dump($result);
        if (count($result)>=0){
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
