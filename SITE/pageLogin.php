<?php
session_start();
//initialisation des variables
$cookiepwd="";
$cookielog="";
//$_POST['pwd']="";
//$_POST['login']="";
$admin="";
//creation du cookie password autopwd date d'expiration dans 5 min
$cookiepwd = ' ' . $_POST['pwd'] . ' '; //on créer une variable qui possède le contenu du champ login
setcookie('autopwd', ' ' . $cookiepwd . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie login autologin? date d'expiration dans 1an
$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ login
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

// champs base de donnée admin_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,ip, newsLetterInscription
// champs formulaire  nom  prenom tel mail adresse  ville cp   majeur reglement  newsletter 
//initialisation de la variable $form en tableau, cette variable se charge de stocker des valeurs du formulaire
//afin de les utiliser dans notre objet new Admin($form), grace à notre hydratation
$form = array();

// $login,            $nomAdm,            $password;
//if (isset($_POST['log'])) {
//    if (!!($_POST['login']) && !!($_POST['pwd'])) {
//        $form['login'] = $_POST['login'];
//        $form['password'] = $_POST['pwd'];
//        $form['nomAdm'] = $_POST['nomAdm'];
//         $form['email'] = $_POST['email'];
//        //nouvel objet  $admin de la classe admin prenant les valeurs du tableau $form
//        $admin = new Admin($form);
//        //on affecte les valeurs  de la fonction addAdmin avec l'objet $admin en argument à l'objet $manager
//        $manager->addAdmin($admin);
//    } else {
//        echo 'erreur de formulaire'; // gestion des erreurs en php
//    }
//    echo ' formulaire ok';
//    var_dump($admin);
//}//fin fonction  formulaire
// D'abord, je me connecte à la base de données.
//mysql_connect("localhost", "root", "");
//mysql_select_db("nom_db");
//
//  sécurisation des données du formulaire
function securisation($champAsecuriser) {

    $champAsecuriser = htmlspecialchars($champAsecuriser);
    $champAsecuriser = trim($champAsecuriser);
    $champAsecuriser = stripcslashes($champAsecuriser);
    $champAsecuriser = strip_tags($champAsecuriser);
    $champAsecuriser = htmlentities($champAsecuriser);
    //  var_dump($champAsecuriser);
    return $champAsecuriser;
}

if (isset($_POST['log'])) {
    $form['password'] = securisation($_POST['pwd']);
    $confirmpwd = securisation($_POST['confirmpwd']);
//    if ($form['pwd'] == $confirmpwd) {
        $form['login'] = securisation($_POST['login']);
        $form['nomAdm'] = securisation($_POST['nomAdm']);
        $form['email'] = securisation($_POST['email']);
// cryptage du mot de pwd par un hachage en md5
//        $form['password'] = md5($form['password']);
        $form['password']= password_hash($form['password'], PASSWORD_DEFAULT);
        
//        $form['confirmpwd'] = md5($form['confirmpwd']);
//        var_dump($form['login']);
//        var_dump($form['nomAdm']);
//        var_dump($form['email']);
//        var_dump($form['pwd']);
//         var_dump($form['confirmpwd']);
        var_dump($form);
                                                      //mysql_query("INSERT INTO validation VALUES('', '$login', '$pwd', '$email')");
        //nouvel objet  $admin de la classe admin prenant les valeurs du tableau $form
        $admin = new Admin($form);
        //on affecte les valeurs  de la fonction addAdmin avec l'objet $admin en argument à l'objet $manager
        $manager->addAdmin($admin);
//    } else {
//        echo 'Les deux mots de pwd que vous avez rentrés ne correspondent pas…';
//    }
//    echo ' formulaire ok';
    var_dump($admin);
}//fin fonction fomulaire isset



var_dump($form);
var_dump($_POST);
//var_dump($db);
//var_dump($_SESSION);
//var_dump($_SERVER);
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
            <label>Nom: <input type="text"  id="nomAdm" name="nomAdm"/></label><br/>
            <label>Pseudo: <input type="text"  id="login" name="login"/></label><br/>
            <label>Mot de pwd: <input type="password" id="pwd" name="pwd"/></label><br/>
            <label>Confirmation du mot de pwd: <input type="password"   id="confirmpwd" name="confirmpwd"/></label><br/>
            <label>Adresse e-mail: <input type="email"  id="email" name="email"/></label><br/>
            <input type="submit"  id="log" name="log" value="M'inscrire"/>
        </form>

    </body>
</html>