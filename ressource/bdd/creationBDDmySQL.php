<!DOCTYPE html>
<html>
    <head>
        <title>Création nouvelle table Base de données PDO MyAdmin MySQL suite</title>

        <meta charset="utf-8"/>
    </head>	
    <body>

        <p><br><strong>creation base et données  </strong><br><br></p>		

        <?php
        $serveur = "localhost";
        $login = "root";
        $pass = "";

        $bdd = "gestion_news"; //mabddtest2";//nom dela base de données
        $table = "news"; //inscrit";//nom de la table
// nom des colonnes		
        $col1 = "id"; //id";//"nb";
        $col2 = "titre"; //id";//"nb";
        $col3 = "auteur"; //prenom";//"id_inscrit";
        $col4 = "contenu"; //nom";
        $col5 = "date_ajout"; //"email";//"mail";
        $col6 = "date_modif"; //"sexe";//"commentaires";
        $col7 = "image"; //"age";//"tel portable";"numero client";
        $col8 = ""; //rue";//"CP";
        $col9 = ""; //ville";
        $col10 = ""; //"pays";
        $col11 = ""; //"CP";
        $col12 = "";


        try {
            $connexion = new PDO("mysql:host=$serveur;dbname=$bdd", $login, $pass);
            $connexion->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //permet de lire les erreurs
///////////////////////////////////////////////////////////////////////
// pour creer une nouvelle base on retire le nom de base 
// !!!!    il y a bien un ;apres serveur, ne pas mettre d'espace dans le $col3 du serveur
// PDO(nom serveur;nom de la BDD,login,mot de passe)
// afin de verifier qu'il n'y a pas de probleme de connexion et evitera que des informations 
// sensibles soient divlguées
// on va refaire une verification avec un TRY et CATCH de controle d'erreur
// ordre en SQL avec la methode exec qui permet d'envoyer des instructions en SQL au MySQL
// par convention on ecrit en Maj dans SQL		
// respecter l'ordre de la base de donnée pour les tables, pour cela on peut aller voir dans 
// myAdmin pour verifier l'ordre
// pour plus de lisibilité on passe par une variable pour inserer le code SQL.			
///////////////////////////////			
            echo'<strong>on commence par créer de la table  </strong>';
/////////////////////////		
                                   //    $codesql =  "CREATE DATABASE $bdd";

                                        $codesql = "CREATE TABLE $table(
		 $col1 INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		 $col2 VARCHAR(50),
		 $col3 VARCHAR(50),
		 $col4 TEXT,
                                        $col5 DATETIME,
                                        $col6 DATETIME,
                                        $col7 TEXT
		
		 )";

            $connexion->exec($codesql);

            echo 'table de la base de données créée ';





///////////////////////////////			
//	echo'<strong>on commence par créer une table avec 10 entrées  </strong>';		
/////////////////////////////
//
//		$insertionSQL="INSERT INTO $table($col2,$col3,$col4)
//		VALUES
//		('muriel','desmedt','muriel@free.fr'),
//		('sebastian','Desmedt','seb@free.fr'),
//		('henry','Gettot','gettot@free.fr'),
//		('sylvie','henriet','henriet@free.fr'),
//		('sylvie','henriet','henriet@free.fr'),
//		('Francois' ,'dechamps','deschamps@free.fr'),
//		('lucille','Desmedt','lulu@free.fr'),
//		('amelie','orpo','orpo@free.fr'),
//		('stan','Futip','futip@free.fr')
//		 ";
///////////////////
            // base1
///////////////////////
            // ('Desmedt','muriel','muriel@free.fr','à bientot'),
            // ('Desmedt','franck','telfd@free.fr','c\'est cool'),
            // ('Desmedt','sebastian','seb@free.fr','j\'ai pas compris les jonctions, c\'est quoi?'),
            // ('Desmedt','franck','telfd@free.fr','une incteraction entre 2 bases'),
            // ('henry','Gettot','gettot@free.fr','super cetait génial'),
            // ('Desmedt','franck','telfd@free.fr','de rien'),
            // ('sylvie','henriet','henriet@free.fr','je nai pas aimé, mais on ne peux pas plaire à tout le monde'),
            // ('Desmedt','franck','telfd@free.fr','c\'est vrai'),
            // ('sylvie','henriet','henriet@free.fr','c\'est peut-etre moi qui ai un pb'),
            // ('Desmedt','franck','telfd@free.fr','sans rancune'),
            // ('dechamps','Francois' ,'deschamps@free.fr','vraiment c\'est top'),
            // ('Desmedt','franck','telfd@free.fr','merci pour ce retour'),
            // ('Desmedt','franck','telfd@free.fr','super ton pseudo'),
            // ('Desmedt','lucille','lulu@free.fr','j\'aime bien aussi le tuto2'),
            // ('Desmedt','franck','telfd@free.fr','au plaisir')
            // ";
///////////////////
            // base2
///////////////////////		///////////////////////
            // ('muriel','Desmedt','muriel@free.fr','à bientot'),
            // ('franck','Desmedt','telfd@free.fr','c\'est cool'),
            // ('sebastian','Desmedt','seb@free.fr','j\'ai pas compris les jonctions, c\'est quoi?'),
            // ('franck','Desmedt','telfd@free.fr','une incteraction entre 2 bases'),
            // ('henry','Gettot','gettot@free.fr','super cetait génial'),
            // ('franck','Desmedt','telfd@free.fr','de rien'),
            // ('sylvie','henriet','henriet@free.fr','je nai pas aimé, mais on ne peux pas plaire à tout le monde'),
            // ('franck','Desmedt','telfd@free.fr','c\'est vrai'),
            // ('sylvie','henriet','henriet@free.fr','c\'est peut-etre moi qui ai un pb'),
            // ('franck','Desmedt','telfd@free.fr','sans rancune'),
            // ('Francois' ,'dechamps','deschamps@free.fr','vraiment c\'est top'),
            // ('franck','Desmedt','telfd@free.fr','merci pour ce retour'),
            // ('franck','Desmedt','telfd@free.fr','super ton pseudo'),
            // ('lucille','Desmedt','lulu@free.fr','j\'aime bien aussi le tuto2'),
            // ('franck','Desmedt','telfd@free.fr','au plaisir')
            // ";
//		
//		$connexion->exec($insertionSQL);
//		echo 'valeurs multiples insérées dans la base de données créée ';
//			
            // respecter l'ordre de la base de donnée pour les tables, pour cela on peut aller voir dans myAdmin pour verifier l'ordre
            // pour plus de lisibilité on passe par une variable pour inserer le code SQL.		
            // ordre en SQL avec la methode exec qui permet d'envoyer des instructions en SQL au MySQL
            // par convention on ecrit en Maj dans SQL
////////////////////////////////////////			
        } catch (PDOException $e) {
            echo 'Echec de la base de donnée ' . $e->$getMessage();
        }
        ?>






    </body>
</html>
