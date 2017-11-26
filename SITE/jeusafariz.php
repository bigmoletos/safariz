<?php
session_start();
//initialisation des variables
$cookiepassword = "";
$cookielog = "";
$cookiemail = "";
$cookienom = "";
$messageinscrit = "";
$messageReglement = "";
$messageMajeur = "";
$messagePerdu = "";
$messageGagne = "";
$messageDejaJoueToday = "";
$messageChampFormulaire = "";
$verif=FALSE;

$_POST[] = "";
//var_dump($_POST);
//$_POST['majeur']="";
//$_POST['reglement']="";
//$_POST['tel']="";
//$_POST['password']="";
//$_POST['login']="";
//$_POST['nom']="";
//$admin="";
////creation du cookie password autopassword date d'expiration dans 5 min
//$cookiepassword = ' ' . $_POST['password'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('autopassword', ' ' . $cookiepassword . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
////creation du cookie login autologin? date d'expiration dans 1an
//$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('autologin', ' ' . $cookiepassword . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie mail date d'expiration dans 5min

if (isset($_POST['bouton'])) {
//suppression cookie
    setcookie('messageGagne');
    setcookie('cookieprenom');
//suppression valeur cookie
    unset($_COOKIE['messageGagne']);
    unset($_COOKIE['prenom']);

    $cookiemail = ' ' . $_POST['mail'] . ' '; //on créer une variable qui possède le contenu du champ mail
    setcookie('mail', ' ' . $cookiemail . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'mail' avec la variable $cookiemail
//creation du cookie nom date d'expiration dans 5min
    $cookienom = ' ' . $_POST['nom'] . ' ';
    setcookie('nom', ' ' . $cookienom . ' ', time() + 5 * 60, null, null, false, true);
//creation du cookie nom date d'expiration dans 5min
    $cookieprenom = ' ' . $_POST['prenom'] . ' ';
    setcookie('prenom', ' ' . $cookieprenom . ' ', time() + 5 * 60, null, null, false, true);
    $clientPassword = $cookiepassword = ' ' . $_POST['password'] . ' ';
    setcookie('password', ' ' . $cookiepassword . ' ', time() + 5 * 60, null, null, false, true);
//}fin verif bouton
//var_dump($_POST);
//var_dump($_COOKIE);
//var_dump($cookieprenom);
//var_dump($cookienom);
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
//if (isset($_POST['majeur'])) {
//  } else {
//             $messageMajeur = "</br>veuillez  confirmer que vous êtes majeur</br>";
//  }
//    if (isset($_POST['reglement'])) {//  !! permet de verifier tous les paramétres(isset, !empty, NOT NULL ...)
    if (isset($_POST['majeur']) && isset($_POST['reglement'])) {
        if (!!($_POST['tel'])) {
            $form['tel'] = $_POST['tel'];
        }
        $form['newsLetterInscription'] = isset($_POST['newsLetter']) ? 1 : 0; //ternaire pour mettre  1  si le client est ok pour la newsletter et 0 s'il n'est pas d'accord
//*********************

//        if (!!($_POST['nom']) && !!($_POST['prenom']) && !!($_POST['mail']) && !!($_POST['adresse']) && !!($_POST['ville']) && !!($_POST['cp'])) {

//gestion du mot de passe facultatif
//    if (!!($_POST['password']) && !!($_POST['confirmpwd'])) {
         //   var_dump($_POST['password']);
        //    var_dump($_POST['confirmpwd']);

            if (isset($_POST['password'])) {
                    $motDePasseVide=FALSE;
          //      var_dump($_POST['password']);
          //      var_dump($_POST['confirmpwd']);
          //      var_dump($_POST);
                //verifie que les 2 mots de passe sont identiques
                if ($_POST['password'] == $_POST['confirmpwd']) {
                    $verif=TRUE;
                   // var_dump($_POST['password']);
                   // var_dump($_POST['confirmpwd']);
                   // var_dump($verif);
                    
                    $form['password'] = securisation($_POST['password']);
                    // $confirmpwd = securisation($_POST['confirmpwd']);
                    // cryptage du mot de pwd par un hachage en md5
                    $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);
                } else {
                     echo 'Vos mots de passe sont différents, veuillez les ressaisir';
                    $messageConfirmationMotPasse = "Vos mots de passe sont différents, veuillez les ressaisir ";
                    //  $cookiemessageConfirmationMotPasse = $messageConfirmationMotPasse;
                    //    setcookie('messageConfirmationMotPasse', ' ' . $cookiemessageConfirmationMotPasse . ' ', time() + 5 * 60, null, null, false, true);
                }
            }//fin if (!!($_POST['password']) && !!($_POST['confirmpwd']))            
//*********************    
            if ((!!($_POST['nom']) && !!($_POST['prenom']) && !!($_POST['mail']) && !!($_POST['adresse']) && !!($_POST['ville']) && !!($_POST['cp']) && $motDePasseVide==TRUE) || (!!($_POST['nom']) && !!($_POST['prenom']) && !!($_POST['mail']) && !!($_POST['adresse']) && !!($_POST['ville']) && !!($_POST['cp']) && $verif==TRUE)){
            $form['nom'] = $_POST['nom'];
            $form['prenom'] = $_POST['prenom'];
            $form['mail'] = $_POST['mail'];
            $form['adresse'] = $_POST['adresse'];
            $form['ville'] = $_POST['ville'];
            $form['cp'] = $_POST['cp'];
            $form['ip'] = $_SERVER['REMOTE_ADDR']; // stocke l'adresse IP
            $form['session_id'] = $_COOKIE['PHPSESSID']; // stocke l'id de session
            //     var_dump($client);
          //  var_dump($form);
            
            //nouvel objet  $client de la classe client prenant les valeurs du tableau $form
            $client = new Client($form);

            //condition vérifiant que le foyer est unique et que le joueur n'a pas déjà joué ce jour
            //        if ($manager->foyerUnique($client) && $manager->ClientPeutJouerCejour($client)) {
                   
            // //0000000000000000000000000000000000000000000000
            //on verifie que le client n'a pas deja ce joué ce jour
            if ($manager->ClientPeutJouerCejour($client)) {
                $messageDejaJoueToday = "</br>Désolé vous avez déjà joué aujourd'hui!, Retentez votre chance demain</br>";
            } else {
                $idclient = $manager->addClient($client);  //inscription dans la base . On affecte les valeurs  de la fonction addClient avec l'objet $client en argument à l'objet $manager
                $messageinscrit = "</br>bravo vous participation au jeu est validée ! </br>";
                //******************************
                // fonction gagné perdu

                $igmanager = new Igmanager($db); //nouvel objet Igmanager avec comme attribut la connexionBdd $db
                if ($donneeClient = $igmanager->GagnePerdu($idclient)) {
                    //  var_dump($donneeClient);
                    $lot = $donneeClient['lot'];
                    // var_dump($lot);

                    $statut = "gagne";
                    //    var_dump($statut);
                    $prenom = $form['prenom'];
                    $nom = $form['nom'];
                    //  $messageGagne = "Félicitation  $prenom  $nom  vous avez gagné le lot suivant:</br> $lot <br/>Vous serez contactez en fin de jeu pour les modalités de retrait de votre gain.<br><br>En attendant, visitez notre site";
                    $messageGagne = "Félicitation $cookieprenom $cookienom  vous avez gagné le lot suivant:</br> $lot ";
                    $cookieMessageGagne = $messageGagne;
                    setcookie('messageGagne', ' ' . $cookieMessageGagne . ' ', time() + 5 * 60, null, null, false, true);

                   ($statut = "gagne") ? header("Location:gagne.php") : "";
                    die('header("Location: gagne.php");');
                    exit;
                } else {
                    $statut = "perdu";
                   ($statut = "perdu") ? header("Location:perdu.php") : "";
                    die('header("Location: perdu.php");');
                    exit;
                    $messagePerdu = "Désolé vous avez perdu, retentez votre chance demain ";
                }
                //******************************
                //  } //var_dump($statut);
                //0000000000000000000000000000000000000000000000000000
            }//fin verif formulaire
//        } else {
//            echo 'Vos mots de passe sont différents, veuillez les ressaisir';
//            $messageConfirmationMotPasse = "Vos mots de passe sont différents, veuillez les ressaisir ";
//            $cookiemessageConfirmationMotPasse = $messageConfirmationMotPasse;
//            setcookie('messageConfirmationMotPasse', ' ' . $cookiemessageConfirmationMotPasse . ' ', time() + 5 * 60, null, null, false, true);
//        }
//                }
//
   }//fin verif confirmation  password
    else {
        (!isset($_POST['majeur']) && isset($_POST['bouton']) ) ? $messageMajeur = "</br>veuillez  confirmer que vous êtes majeur</br>" : $messageMajeur = "";
        (!isset($_POST['reglement']) && isset($_POST['bouton']) ) ? $messageReglement = "</br>veuillez accepter le réglement </br>" : $messageReglement = "";
    }
            }//fin verif  regglement majeur
//}//fin verif formulaire
}//fin bouton
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
<!DOCTYPE html>

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
    <body>

        <?php include ('form.php'); ?>
    </body>
</html>







