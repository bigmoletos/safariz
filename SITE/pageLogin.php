<?php
session_start();
//creation du cookie password autopwd date d'expiration dans 5 min
$cookiepwd = ' ' . $_POST['pwd'] . ' '; //on créer une variable qui possède le contenu du champ pseudo
setcookie('autopwd', ' ' . $cookiepwd . ' ', time() + 5*60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie login autologin? date d'expiration dans 1an
$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ pseudo
setcookie('autologin', ' ' . $cookiepwd . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//chargement des classes
require('chargeurClass.php');
//chargement de la connexion
// a enlever si l'autoload fonctionne
require ('classes/AdminManager.php');
require ('classes/Admin.php');

require('connexionBD.php');
//require('admin.php');
$db = connexionDB();

$manager = new AdminManager($db);

date_default_timezone_set("Europe/Paris");

// champs base de donnée client_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,ip, newsLetterInscription
// champs formulaire  nom  prenom tel mail adresse  ville cp   majeur reglement  newsletter 
//initialisation de la variable $form en tableau, cette variable se charge de stocker des valeurs du formulaire
//afin de les utiliser dans notre objet new Admin($form), grace à notre hydratation
$form = array();
var_dump($_POST);
// $login,            $nomAdm,            $password;
if(isset($_POST['log'])){
    if (!!($_POST['login']) && !!($_POST['pwd']) ) {
        $form['nomAdm'] = $_POST['nomAdm'];
        $form['password'] = $_POST['pwd'];
        //nouvel objet  $admin de la classe client prenant les valeurs du tableau $form
        $admin = new Admin($form);
        //on affecte les valeurs  de la fonction addAdmin avec l'objet $admin en argument à l'objet $manager
        $manager->addAdmin($admin);
    } else {
        echo 'erreur de formulaire'; // gestion des erreurs en php
    }
    echo ' formulaire ok';
    var_dump($admin);
    
}//fin fonction  formulaire








var_dump($db);
var_dump($_SESSION);
var_dump($_SERVER);
var_dump($_COOKIE);





?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Page login</title>
</head>
<body>
	<!--<form name="administrateur" action="pageAdministrateur.php" method="post">-->
        <form name="administrateur" action="pageLogin.php" method="post">
		login
		<input name="login"  id="login"  type="text" ><br/><br/>
		Password :
		<input name="pwd" id="pwd"  type="password"><br/><br/>
	
		<input type="submit"  id="log"  value="connexion"><br/>
	</form>
</body>
</html>