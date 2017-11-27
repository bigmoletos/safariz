<?php
session_start();
set_include_path(dirname(__FILE__));
require_once('chargeurClass.php');
require_once('connexionBD.php');
require_once('classes/AdminJeu.php');
//require('admin.php');

$db = connexionDB();
$manager = new ClientManager($db);

////suppression cookie
//var_dump($_SESSION);
setcookie('messageGagne');
setcookie('cookieprenom');
setcookie('infosClient');

//suppression valeur cookie
unset($_COOKIE['messageGagne']);
unset($_COOKIE['prenom']);
unset($_COOKIE['infosClient']);


$form['nom'] = $_SESSION['infosClient']['nom'];
$form['prenom'] = $_SESSION['infosClient']['prenom'];
$form['adresse'] = $_SESSION['infosClient']['adresse'];
$form['ville'] = $_SESSION['infosClient']['ville'];
$form['cp'] = $_SESSION['infosClient']['cp'];
$form['ip'] = $_SERVER['REMOTE_ADDR']; // stocke l'adresse IP
$form['session_id'] = $_COOKIE['PHPSESSID']; // stocke l'id de session
$form['mail'] = $_SESSION['infosClient']['mail'];
$form['password'] = $_SESSION['infosClient']['password'];


$idclient = $_SESSION['infosClient']['client_id'];
//var_dump($form);
//var_dump($_COOKIE);
$LogClient = new Client($form);
$verificationLog = $manager->clientLogin($LogClient);
//var_dump($verificationLog);
//on verifie que le client n'a pas déjà joué aujourd'hui
$manager->ClientPeutJouerCejour($LogClient);
//var_dump($manager);

$gagnant = new gagnantsManager($db);
//test pour  savoir si la participant n'a pas deja gagné auquel cas s'il rejoue il aura le message perdu
//var_dump($gagnant);
$pasDejaGagne = $gagnant->pasDejaGagne($idclient);


if ($manager->ClientPeutJouerCejour($LogClient)) {
    // var_dump($manager);
    $messageDejaJoueToday = "</br>Désolé vous avez déjà joué aujourd'hui!, Retentez votre chance demain</br>";
} elseif ($pasDejaGagne) {

    var_dump($pasDejaGagne);
    // echo "vous avez  déjà gagné ";
    $messageDejaGagne = "vous avez  déjà gagné ! vous ne pouvez rejouer ";
    $statut = "perdu";
    ($statut = "perdu") ? header("Location:perdu.php") : "";
    die('header("Location:perdu.php");');
    exit;
    $messagePerdu = "Désolé vous avez perdu, retentez votre chance demain ";
}//fin du else de client peutJouerCejour
else {
    if ($igmanager = new Igmanager($db)) {
        //nouvel objet Igmanager avec comme attribut la connexionBdd $db
        // var_dump($igmanager);



        if ($lot = $igmanager->GagnePerdu($idclient)) {
            // fonction pour donner le nom
//echo "Félicitation $cookieprenom $cookienom  vous avez gagné le lot suivant: $lot ";
            //   header('Location: gagne.php');
            //var_dump($lot);
            $statut = "gagne";
            //    var_dump($statut);
            $prenom = $form['prenom'];
            $nom = $form['nom'];
            // var_dump($form);

            $LogClient = new Client($form);
            $verificationLog = $manager->clientLogin($LogClient);


            //  $messageGagne = "Félicitation  $prenom  $nom  vous avez gagné le lot suivant:</br> $lot <br/>Vous serez contactez en fin de jeu pour les modalités de retrait de votre gain.<br><br>En attendant, visitez notre site";
            $messageGagne = "Félicitation $prenom $nom  vous avez gagné le lot suivant:</br> $lot ";
            $cookieMessageGagne = $messageGagne;
            setcookie('messageGagne', ' ' . $cookieMessageGagne . ' ', time() + 5 * 60, null, null, false, true);

            ($statut = "gagne") ? header("Location:gagne.php") : "";
        } else {
            $statut = "perdu";
            ($statut = "perdu") ? header("Location:perdu.php") : "";
            $messagePerdu = "Désolé vous avez perdu, retentez votre chance demain ";
        }



//$now = date("Y-m-d");
//$date_debut_jeu=$dates['date_debut_jeu']  ;
//$date_fin_jeu=$dates['date_fin_jeu'];
//if ($now >= $date_debut_jeu && $now <= $date_fin_jeu) {
        $message = 'Cliquez pour participer à notre jeu Safa\'Riz<br/><br/><a href="jeusafariz.php"><button class="jouer" name="bouton" type="submit" style="color:white;">JOUER</button>';
    }
}
//elseif ($now <= $date_debut_jeu){
//    $message = "Désolé le jeu n'est pas ouvert actuellement.<br/>Reconnectez-vous à partir du ".$date_debut_jeu;
//}
// else {
//    $message = "Désolé ce jeu est terminé.";    
//}
?>

<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Accés Participant</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="style/styleFormulaire.css" type="text/css" charset="utf_8"/>
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
        <link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="style/bootstrap-iso.css"/>
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/style.css">
    </head>

    <body class="container">
        <section id="header" class="row">
            <div id="logo_safariz" class="col-sm-12 col-md-3">
                <a href="index.php"><img src="image/safariz.png" alt="logo safariz" height="190" width="250" responsive-image></a>
            </div>

            <main id="content" class="col-sm-12 col-md-9">

                <div class="bootstrap-iso"><!-- <div class="container-fluid"> -->

                    <div class="well">
                        <div id="messageIndex" class="row">
                            <!--titre-->
                            <div class="col-12">
                                <h1><?php  echo (isset($messagePerdu)) ? $messagePerdu : "";
                                    echo (isset($messageGagne)) ? $messageGagne : "";
                                    echo (isset($messageDejaJoueToday)) ? $messageDejaJoueToday : "";
                                    echo (isset($messageChampFormulaire)) ? $messageChampFormulaire : "";
                                    echo (isset($message)) ? $message : ""; 
                                    
                                    ?></h1>
                            </div>
                        </div>

                    </div><!--</div> container.fluid-->
                </div>

            </main><!-- content -->
        </section>

<?php include("footer.php"); ?>
    </body>
</html>