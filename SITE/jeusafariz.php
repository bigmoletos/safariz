<?php
session_start();
//initialisation des variables
$cookiepwd = "";
$cookielog = "";
$cookiemail = "";
$cookienom = "";
$messageinscrit = "";
$messageReglement = "";
$messagePerdu = "";
$messageGagne = "";
$messageDejaJoueToday = "";
$messageChampFormulaire = "";
////$_POST['pwd']="";
////$_POST['login']="";
//$admin="";
////creation du cookie password autopwd date d'expiration dans 5 min
//$cookiepwd = ' ' . $_POST['pwd'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('autopwd', ' ' . $cookiepwd . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
////creation du cookie login autologin? date d'expiration dans 1an
//$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('autologin', ' ' . $cookiepwd . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie mail date d'expiration dans 5min

if(isset($_POST['inscription'])){
$cookiemail = ' ' . $_POST['mail'] . ' '; //on créer une variable qui possède le contenu du champ login
setcookie('mail', ' ' . $cookiemail . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie nom date d'expiration dans 5min
$cookienom = ' ' . $_POST['nom'] . ' '; //on créer une variable qui possède le contenu du champ login
setcookie('nom', ' ' . $cookienom . ' ', time() + 5 * 60, null, null, false, true);
//creation du cookie nom date d'expiration dans 5min
$cookieprenom = ' ' . $_POST['prenom'] . ' '; //on créer une variable qui possède le contenu du champ login
setcookie('prenom', ' ' . $cookieprenom . ' ', time() + 5 * 60, null, null, false, true);
}
//var_dump($_COOKIE);
//chargement des classes
require('chargeurClass.php');
//chargement de la connexion
// a enlever si l'autoload fonctionne
//require ('classes/clientManager.php');
//require ('classes/client.php');

require('connexionBD.php');
//require('admin.php');
$db = connexionDB();

//nouvel objet de la classe ClientManager instancié 
//par les attributs de la connexionDB() à la base donnée mysql
$manager = new ClientManager($db);

date_default_timezone_set("Europe/Paris");

// champs base de donnée client_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,ip, newsLetterInscription
// champs formulaire  nom  prenom tel mail adresse  ville cp   majeur reglement  newsletter 
//initialisation de la variable $form en tableau, cette variable se charge de stocker des valeurs du formulaire
//afin de les utiliser dans notre objet new Client($form), grace à notre hydratation
$form = array();
$statut = "";
//var_dump($_POST);
//*************************************************************************************
if (isset($_POST['majeur']) && isset($_POST['reglement'])) {//  !! permet de verifier tous les paramétres(isset, !empty, NOT NULL ...)
    if (!!($_POST['tel'])) {
        $form['tel'] = $_POST['tel'];
    }
    $form['newsLetterInscription'] = isset($_POST['newsLetter']) ? 1 : 0; //ternaire pour mettre  1  si le client est ok pour la newsletter et 0 s'il n'est pas d'accord

    if (!!($_POST['nom']) && !!($_POST['prenom']) && !!($_POST['mail']) && !!($_POST['adresse']) && !!($_POST['ville']) && !!($_POST['cp'])) {
        $form['nom'] = $_POST['nom'];
        $form['prenom'] = $_POST['prenom'];
        $form['mail'] = $_POST['mail'];
        $form['adresse'] = $_POST['adresse'];
        $form['ville'] = $_POST['ville'];
        $form['cp'] = $_POST['cp'];
//     $form['dateinscription']= now();//finalement pour rentrer la date on va utiliser la base de donnée en 
//     mettant dateInscription en CURRENT_TIMESTAMP par defaut
        $form['ip'] = $_SERVER['REMOTE_ADDR']; // stocke l'adresse IP
        $form['session_id'] = $_COOKIE['PHPSESSID']; // stocke l'id de session
        //la fonction isValidFormulaire
        // avant d'envoyer les données formulaire dans la base nous verifions que les formats nom adresse cp ...sont conformes
//     var_dump($client);
     var_dump($form);
        //nouvel objet  $client de la classe client prenant les valeurs du tableau $form
        $client = new Client($form);
        //condition vérifiant que le foyer est unique et que le joueur n'a pas déjà joué ce jour
                    //        if ($manager->foyerUnique($client) && $manager->ClientPeutJouerCejour($client)) {
       
        //0000000000000000000000000000000000000000000000
        //methode add
        if ($manager->ClientPeutJouerCejour($client)) {
            $messageDejaJoueToday = "</br>Désolé vous avez déjà joué aujourd'hui!, Retentez votre chance demain</br>";
        } else {
            $manager->addClient($client);  //inscription dans la base . On affecte les valeurs  de la fonction addClient avec l'objet $client en argument à l'objet $manager
            $messageinscrit = "</br>bravo vous êtes inscrit ! </br>";
            //******************************
            // fonction gagné perdu

            $igmanager = new Igmanager($db); //nouvel objet Igmanager avec comme attribut la connexionBdd $db
            if ($lot = $igmanager->GagnePerdu()) {
                //todo fonction pour donner le nom
//echo "Félicitation $cookieprenom $cookienom  vous avez gagné le lot suivant: $lot ";
                $statut = "gagne";
                $messageGagne = "Félicitation $cookieprenom $cookienom  vous avez gagné le lot suivant: $lot ";
                ($statut="gagne")? header("Location: gagne.php"):"";
            } else {
                 $statut = "perdu";
                 ($statut="perdu")?header("Location: perdu.php"):"";
                $messagePerdu = "Désolé vous avez perdu, retentez votre chance demain ";
            }
            //******************************
        }
        //0000000000000000000000000000000000000000000000000000
        //  echo ' </br>formulaire ok </br>';
    } else {
        $messageChampFormulaire = '</br></br>Veuillez remplir tous les champs du  formulaire</br></br>'; // gestion des erreurs en php
    }





//    var_dump($client);
} else {
    $messageReglement = "</br>veuillez accepter le réglement et confirmer que vous êtes majeur</br>";
} //fin fonction  formulaire
//*************************************************************************************
//*/*******************************************************
//fonction pour verifier le mail 
//ne fonctionne pas
//Cette fonction sert à vérifier la syntaxe d'un email
//	function IsEmail($email)
//	{
//$var regexMail = preg_match('/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/', $email);
//return (($value === 0) || ($value === false)) ? false : true;
//	}

function securisation($champAsecuriser) {

    $champAsecuriser = htmlspecialchars($champAsecuriser);
    $champAsecuriser = trim($champAsecuriser);
    $champAsecuriser = stripcslashes($champAsecuriser);
    $champAsecuriser = strip_tags($champAsecuriser);
    $champAsecuriser = htmlentities($champAsecuriser);

    //  var_dump($champAsecuriser);
    return $champAsecuriser;
}

//donne la date et l'heure de la session
$TimeValidation = $_SERVER['REQUEST_TIME_FLOAT'];
//conversion au formatDateTime($heureValidation);
$TimeValidation = date("Y-m-d H:i:s ", $TimeValidation);
//var_dump($TimeValidation);


//********************
//verifications variables globales
////var_dump($db);
//var_dump($_SESSION);
//var_dump($_SERVER);
//var_dump($_COOKIE);
//********************


//********************
//redirection vers la page gagne ou perdu
//$url=$_SERVER['SCRIPT_NAME'];
//var_dump($url);
//($statut="gagne")? header("Location: $url/gagne.php/"):"";
//($statut="perdu")?header("Location: $url/perdu.php/"):"";
//********************


?>
<!--<!DOCTYPE html>

formulaire d'inscription 

<html>
    <head>
        <title>Formulaire d'inscription</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style/styleFormulaire.css" type="text/css" charset="utf_8"/>
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style/style.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="style/bootstrap-iso.css"/>
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>


    </head>
    <body>-->
        
 <?php //include ('header.php'); ?>       
<?php include ('form.php'); ?>
    </body>
</html>







