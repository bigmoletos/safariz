<?php

//classe repercutant les actions de la classse news dans la base de données
//on va faire une classe




class NewsManager {

    //attribut
    private $db;

    //methode constructeur
    //on met (PDO $db) car on a besoin d'un objet pdo car le new=PDO(......) du connexion fait un objet PDO
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // methode getter
    public function getDb() {
        return $this->db;
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
    // méthode add() pour ajouter des enregistrements en base de données (insert)
    //fonction faisant appel à la classe News, avec un objet $news
    //on passe l'objet news car c'est celui quon passe dans le bdr
    public function addNews(News $news) {
        try {
            //on fait le prepare et on l'affecte à la variable $req
            //on affecte à la variable $req la valeur de l'objet $news ($this->db) puis on prepare les données        
//                $req =$this->db->prepare('
//                    select * 
//                    from News 
//                    where 
//                    and titre = :titre 
//                    and auteur = :auteur 
//                    and contenu = :contenu 
//                    and date_ajout = :date_ajout');
            //pour mettre les date en francais dans la requete
              $bdd->query(" SET lc_time_names = 'fr_FR'");
            $req = $this->db->prepare("INSERT INTO news (titre, auteur, contenu, date_ajout, date_modif )"
                    . " VALUES (:titre, :auteur, :contenu, Now(), Now())");

            //version binValue et non array car on melange des chaines de caracteres avec des entiers
            //   $req->binValue(':id', $_POST['id']);//inutile car est en auto-increment dans la base de donnée
            
            $req->binValue(':titre', $news->Titre());
            $req->binValue(':auteur', $news->Auteur());
            $req->binValue(':contenu', $news->Contenu());
            if ($req->exec()) {
                echo "news correctement insérée";
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
//                . "INSERT INTO news(titre, auteur, contenu,date_ajout, date_modif ) "
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
        //id etant un entier et  non un objet (contrairement à $news) il est faux de le mettre en attribut de classe (news $id)

//    //    public function Load($id) {
//        $req=$this->db->prepare('SELECT * FROM news WHERE id=$id ');
//        //on indique que l'on utilise les reusltats en tant que classe en faisant appel à la classe news
//       
//               
//               
//        
//        $req->setFetchMode (PDO::FETCH_CLASS, 'news');
//       //on execute la requete
//        $resultat=$req->execute();
//        //on retourne la ligne par fetch()
//        return $resultat->fetch();       
//    }
    
//version david
    public function load($id) {
         //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, date_ajout, date_modif, image FROM news WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS, 'News');
        $news = $requete->fetch();
        $news->setDate_ajout(new DateTime($news->getDate_ajout()));
        $news->setDate_modif(new DateTime($news->getDate_modif()));
       var_dump($news);
        return $news;
    
    }
    
//**************************************************
   

    //**************************************************   
    // méthode update() pour pouvoir modifier des enregistrements en base de données
    //(update) à faire sur les 3 champs, inutile de verifier
    protected function update(News $news) {
         //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $requete = $this->db->prepare('UPDATE news SET'
                . ' auteur = :auteur, titre = :titre, contenu = :contenu, date_modif = NOW(), image = :image '
                . 'WHERE id = :id');
        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':contenu', $news->contenu());
        $requete->bindValue(':image', $news->image());
        $requete->bindValue(':id', $news->id(), PDO::PARAM_INT);
        $requete->execute();
    }

    //**************************************************   
    // méthode delete() pour pouvoir supprimer des enregistrements de la base de données
    //(delete)
    public function delete($id) {
        $this->db->exec('DELETE FROM news WHERE id = ' . (int) $id);
    }

//**************************************************
    // méthode save() permettant de vérifier une news isValid(), et si elle est isNew(),
    //pus l’ajoute avec addnews(), sinon la modifier avec update()
     public function save(News $news) {
        if ($news->isValid()) {
            $news->isNew() ? $this->addNews($news) : $this->update($news);
        } else {
            throw new Exception('La news doit être valide pour être enregistrée');
        }
    }
    
    
     // méthode liste() pour charger les N dernieres news les plus 
    // recentes (select) N est un parametre à passer à liste ($n), mettre une limite (SELECT * FROM ma_table LIMIT 100;)
   
    //methode getlist
     public function getList($debut = null, $limite = null) {
          //pour mettre les date en francais dans la requete
        //  $requete->query('SET lc_time_names = \'fr_FR\'');
        $sql = 'SELECT id, auteur, titre, contenu, date_ajout, date_modif, image FROM news ORDER BY id DESC';

        // On vérifie l'intégrité des paramètres fournis.
        if (!is_null($debut) || !is_null($limite)) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }  
        $requete = $this->db->query($sql);
        //avec un while on aurait mit un FETCH_ASSOC
        $requete->setFetchMode(PDO::FETCH_CLASS, 'News');
        $listeNews = $requete->fetchAll();
        // On parcourt notre liste de news pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
        foreach ($listeNews as $news) {
            $news->setDate_ajout(new DateTime($news->getDate_ajout()));
            $news->setDate_modif(new DateTime($news->getDate_modif()));
            
        }
        //permet de fermer la requete
      // var_dump($listeNews);
        $requete->closeCursor();
        
        return $listeNews;
        
    }

    
    
    
    
    
    //methode count permet de compter le nombre de news dans la bdr
     public function count() {
        $count = $this->db->query('SELECT COUNT(*) FROM news');
        return $count->fetchColumn();
    }
    
    //**************************************************    
    
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
//                       'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
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
                   
               /***  <img src="nom du dossier/ <?php echo $donnees['image']; ?> "/>***/
//
        //Et ton image sera alors affichée.




    //**************************************************   
//methode permetttant de verifier le login utilisateur à la bdr
//  verif login
//  
//    $pseudo_Exist = $bd->prepare("SELECT pseudo FROM news WHERE pseudo = :pseudo");
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

    