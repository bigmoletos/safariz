<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//****************************
//                fonction pour se connecter à la base de données
//en dehors de la fonction il faudra faire un set $db poour l'appeler
 
function connexionDB() {



    $bdd ="safariz";//"gestion_news";// "pdo_tp1_news";
    $utilisateur = "root";
    $motdepasse = "root";
    $serveur = "localhost";
    $driver = "mysql:host=$serveur;dbname=$bdd";

// nom des colonnes		
//        $col1="id";//"nb";
//        $col2="auteur";//"id_inscrit";
//        $col3="titre";
//        $col4="contenu";//"mail";
//        $col5="date_ajout";//"commentaires";
//        $col6="date_modif";//"tel portable";"numero client";
//        $col7="";//rue";//"CP";
//        $col8="";//ville";
//        $col8="";//pays";
//        $col9="";//CP";
//        $col10="";

      
    try {

        //   $connexion=new PDO('mysql:host=$serveur;dbname=$bdd',$login,$pass);
        $connexion = new PDO($driver, $utilisateur, $motdepasse);
        $connexion->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
        $db=$connexion;
        echo "connexion à la base de donnée:'  $bdd ' de mysql réussie";
        return $db; //en dehors de la fonction il faudra faire un set $db poour l'appeler
        
        
    } catch (Exception $e) {
        echo "La connection à votre base est impossible, veuillez verifier vos parametres", $e->getMessage();
        //    var_dump($e);
        die();
        //    autre possiblite mettre le die devant il affichera le message comme le echo
        //    die ("connection à mysql impossible", $e->getMessage());
    }
}
//http://localhost/TP_SOFTEAM/PDO/tp1/index.php //ne marche pas
// http://localhost/TP_SOFTEAM/softeam/TP/PDO/tp1/   


//**************************

//    $select = $db->query("SELECT * FROM auteur");


//affichage des données de notre table
//    $select->setfetchMode(PDO::FETCH_OBJ);
//    var_dump($select);


//PDO::FETCH ASSOC : retourne chaque ligne dans un tableau
//indexé par les noms des colonnes comme elles sont retournées
//dans le jeu de r ´ esultats correspondant.
//PDO::FETCH NUM : retourne chaque ligne dans un tableau indexé
//par le numéro des colonnes en commenc¸ant `a 0.
//PDO::FETCH BOTH : retourne chaque ligne dans un tableau
//indexé par les noms des colonnes ainsi que leurs numéros, en
//commenc¸ant `a 0.
//PDO::FETCH OBJ : retourne chaque ligne dans un objet avec les
//noms de propri ´ et és correspondant aux noms des colonnes
//comme elles sont retournées dans le jeu de r ´ esultats.
//PDO::FETCH CLASS ou PDO::FETCH CLASSTYPE : retourne
//une nouvelle instance de la classe demandée, liant les colonnes
//aux propri ´ et és nommées dans la classe.
//modification des données de notre table


//        while ($enregistrement = $select->fetch()) {
    

//traitement des resultats en boucle
//    while ($enregistrement=$select->fetch())
//affichage des champs
//            echo '<h1>', $enregistrement->NUMFACTURE, ' ', $enregistrement->NUMCONS, ' ', $enregristrement->QTE, ' <h1>';
//        }
//        try {
//            $update = $connexion->exec("UPDATE lestables SET NBPLACE=3 WHERE NUMTABLE=7");
//        } catch (Exception $ex) {
//            echo "erreur lors de la modif";



//protection injection SQL
//BIT$nom connexion->quote($nom chaıne) : desactive les
//quotes inserées par l’utilisateur
//htmlspecialchars($nom chaıne) : élimine les < et >. Pour
//récuperer la chaˆıne d’origine on peut utiliser
//htmlspecialchars decode().
//strip tags($nom chaıne) : supprime les balises html et php
//stripcslashes : supprime les antislash d’une chaıne de
//caractère.
//htmlentities($nom chaıne) : remplace les ’ ” < > par leur
//code html (&lt ;...). Pour récup erer la chaˆıne d’origine on peut
//utiliser html entity decode().
//addcslashes() : ajoute des slashs devant des caract ères
//mentionnés d’une chaˆıne de caractère.



