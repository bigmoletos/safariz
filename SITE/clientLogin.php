<?php
session_start();
//initialisation des variables
//$cookiepwd = "";
//$cookielog = "";
//$_POST['pwd']="";
//$_POST['password']="";
$admin = "";
$_SESSION['messageLoginClientKo'] = "";
$_SESSION['messageLoginClient'] = "";

//creation du cookie password autopwd date d'expiration dans 5 min
//$cookiepwd = ' ' . $_POST['pwd'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('cookiepwd', ' ' . $cookiepwd . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie login autologin? date d'expiration dans 1an
//$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('cookielog', ' ' . $cookielog . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//var_dump($_SESSION);

//chargement des classes
require('chargeurClass.php');
//chargement de la connexion
require('connexionBD.php');
//require('admin.php');
$db = connexionDB();

$manager = new ClientManager($db);

date_default_timezone_set("Europe/Paris");

// champs base de donnée admin_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,ip, newsLetterInscription
// champs formulaire  nom  prenom tel mail adresse  ville cp   majeur reglement  newsletter 
//initialisation de la variable $form en tableau, cette variable se charge de stocker des valeurs du formulaire
//afin de les utiliser dans notre objet new Client($form), grace à notre hydratation
$form = array();

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

$form = array();
//var_dump($_POST);
//
//recharge la page 
if (!empty($_POST))
    echo '<script>window.location.href("clientLogin.php")</script>';

//if (isset($_POST['accesClient'])) {
if (isset($_POST['veriflog'])) {
    //creation du cookie login autologin? date d'expiration dans 1an
    $securisationLog = securisation($_POST['password']);
    $cookielog = ' ' . $securisationLog . ' '; //on créer une variable qui possède le contenu du champ password
    setcookie('cookielog', ' ' . $cookielog . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    $securisationClient = securisation($_POST['mailClient']);
    $cookiemailClient = ' ' . $securisationClient . ' '; //on créer une variable qui possède le contenu du champ password
    setcookie('cookiemailClient', ' ' . $cookiemailClient . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    //  var_dump($cookiemailClient);
    //  var_dump($cookielog);

    if (!!($_POST['password']) && !!($_POST['mailClient'])) {
        $form['password'] = securisation($_POST['password']);

        $form['mail'] = securisation($_POST['mailClient']);
        $LogClient = new Client($form);
        $verificationLog = $manager->clientLogin($LogClient);
        //  var_dump($verificationLog);
        $hash = $verificationLog['password'];
        $nom = $verificationLog['nom'];
        $prenom = $verificationLog['prenom'];
        //$cookieInfosClient = $verificationLog;
        // $cookieInfosClient = serialize($cookieInfosClient);
        // setcookie('infosClient', ' ' . $cookieInfosClient . ' ', time() + 5 * 60, null, null, false, true);
        // var_dump($_COOKIE);

        $_SESSION['infosClient'] = $verificationLog;
        //    var_dump($_SESSION);
        // var_dump($_SESSION['infosClient']);
        //    var_dump($hash);

        //verification du mot de passe
        if (password_verify($form['password'], $hash)) {

            //   echo "mot de passe ok Bonjour $prenom $nom  nous vous souhaitons bonne chance!</br>";
            $messageLoginClient = "Bonjour $prenom $nom nous vous souhaitons bonne chance aujourd'hui!</br>  ";
            // $cookiemessageLoginClient = $messageLoginClient;
            $_SESSION['messageLoginClientKo'] = "";
            $_SESSION['messageLoginClient'] = $messageLoginClient;
            
            //      setcookie('messageLoginClient', ' ' . $cookiemessageLoginClient . ' ', time() + 5 * 60, null, null, false, true);
            //  var_dump($_COOKIE);
            // var_dump($_SESSION);
            // var_dump($cookiemessageLoginClient);
            //  var_dump($infosClient);
            header('location:joueurInscrit.php');
//            die('header("location: joueurInscrit.php");');
            exit;
        } else {
            // echo 'mot de passe incorrect veuillez le ressaisir';
            $messageLoginClientKo = "mail ou mot de passe incorrect veuillez le ressaisir</br>  ";
            //   $cookiemessageLoginClientKo = $messageLoginClientKo;

            $_SESSION['messageLoginClientKo'] = $messageLoginClientKo;
            //      setcookie('messageLoginClientKo', ' ' . $cookiemessageLoginClientKo . ' ', time() + 5 * 60, null, null, false, true);
            //  var_dump($_SESSION);
        }
    }
}////fin fonction fomulaire test !! password
//              }//fin fonction fomulaire isset veriflog
//var_dump($form);
//var_dump($_POST);
//var_dump($db);
//var_dump($_SESSION);
//var_dump($_SERVER);
//var_dump($_COOKIE);
?>
<!DOCTYPE html>



<html>
    <head>
        <title>Formulaire d'inscription</title>
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
        <link rel="stylesheet" href="style/style.css">

    </head>
    <body>


        <?php include("header.php"); ?>
        <main id="content" class="col-12 col-md-9">  
            <div class="bootstrap-iso">
                <!-- <div class="container-fluid"> -->
                <div class="well">
                    <div class="row">
                        <!--<div class="col-12">-->
                        <div class="col-8">
                            <h1>Accès participant</h1>
                            <p>Tous les champs marqués d'une <span class="asteriskField"> *</span> sont obligatoires</p>
                        </div>
                        <div class="col-4"><!--zone pour integrer les messages de retour-->        
                            <div id="message_retour" >               
                                <p> 
                                    <?php
//                            var_dump($messageReglement);
//                            var_dump($messageinscrit);
//                            var_dump($messageChampFormulaire);
//                            var_dump($messageDejaJoueToday);
                                    echo (isset($messageinscrit)) ? $messageinscrit : "";
                                    echo (isset($messageMail)) ? $messageMail : "";
                                    echo (isset($messageReglement)) ? $messageReglement : "";
                                    echo (isset($messageMajeur)) ? $messageMajeur : "";
                                    echo (isset($messagePerdu)) ? $messagePerdu : "";
                                    echo (isset($messageGagne)) ? $messageGagne : "";
                                    echo (isset($messageDejaJoueToday)) ? $messageDejaJoueToday : "";
                                    echo (isset($messageChampFormulaire)) ? $messageChampFormulaire : "";
                                    echo (isset($messageLoginClient)) ? $messageLoginClient : "";
//                                    echo (isset($_COOKIE['messageLoginClient'])) ? $_COOKIE['messageLoginClient'] : "";
//                                    echo (isset($_COOKIE['messageLoginClientKo'])) ? $_COOKIE['messageLoginClientKo'] : "";
                                    echo (isset($_SESSION['messageLoginClient'])) ? $_SESSION['messageLoginClient'] : "";
                                    echo (isset($_SESSION['messageLoginClientKo'])) ? $_SESSION['messageLoginClientKo'] : "";
                                    ?>
                                </p>
                            </div><!--fin messages retour-->
                        </div> 
                        <!--</div>-->
                        <form method="post" name="accesClient" id='accesClient'  action=clientLogin.php onsubmit="return verifForm(this)">                               

                            <div class="col-12 col-md-6">
                                <label class="control-label requiredField" id='mail' for="mail">Email<span class="asteriskField">*</span></label>
                                <div class="input-group"><div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input class="form-control" id="mailClient" name="mailClient" type="email"  minlength="3" maxlength="48"  placeholder="xxxx@xxxx.xx" onblur="verifMail(this)"   required/></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="control-label requiredField" for="password">Mot de passe<span class="asteriskField"> *</span></label>
                                <div class="input-group"><div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div>
                                    <input class="form-control" id="password" name="password" placeholder="votre mot de passe..." type="password" minlength="3" maxlength="48" onblur="verifPassword(this)"   required/></div>
                            </div>
                            <!--                    </div>-->
                    </div>
                    <br>
                    <div id="espace"></div><!--espace-->
                    <div class="row">
                        <div class="col-12">
                            <div class="col-md-7 col-sm-6 col-xs-12 text-center"><p><a href="">Mot de passe oublié ?</a></p></div>

                            <div class="col-md-5 col-sm-6 col-xs-12 text-center">
                                <div class="form-group">
                                    <div><button class="btn btn-primary" id="veriflog" name="veriflog" type="submit">Valider</button></div>
                                </div>
                            </div>
                        </div>
                    </div>   
                    </form>
                </div>
            </div>
        </main>

        <?php include("footer.php"); ?>

        <script>
            //function qui change le fond en rouge si erreur de saisie d'un champ
            function surligne(champ, erreur)
            {
                if (erreur)
                    champ.style.backgroundColor = "#fba";
                else
                    champ.style.backgroundColor = "";
            }

            //function de verification du champ mail
            function verifMail(champ)
            {
                var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,6}$/;
                if (!regex.test(champ.value))
                {
                    // var messageMail= "Veuillez remplir correctement  le champ mail ";
                    //    alert("Veuillez remplir correctement  le champ mail ");
                    //  document.write(messageMail);

                    return false;
                } else
                {
                    surligne(champ, false);
                    ;
                    return true;
                }
            }
//function de verification du champ password
            function verifPassword(champ)
            {
                if (champ.value.length < 3 || champ.value.length > 25)
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
                {
                    surligne(champ, true);
//            str.charAt(0).toUpperCase();
//           champ=champ.charAt(0).toUpperCase() + champ.substring(1).toLowerCase();

                    return false;
                } else
                {
                    surligne(champ, false);
                    return true;
                }
            }

            //verif complete des champs du formulaire
            function verifForm(f)
            {
                var passwordOk = verifPassword(f.password);
                var mailOk = verifMail(f.mailClient);

                if (mailOk && passwordOk)
                    return true;
                else
                {
                    alert("Veuillez remplir correctement tous les champs");
                    return false;
                }
            }

            //message personnalise champ mail
//    var email = document.getElementById("mailClient");
//    email.addEventListener("keyup", function (event) {
//        if (email.validity.typeMismatch) {
//            email.setCustomValidity("Vraiment naze ton adresse e-mail! on attend le format suivant : xxxx@xxxx.xx");
//        }
//    });
//            
            //        controle de saisie dynamique du champ password afin de verifier qu'il n'existe pas
            //         deja dans la base, réalisé en AJAX
//            $(document).ready(
//                    function () {
//                        $("#txt").keyup(function () {
//                            $("#password").load("classes/ClientManager.php", {q: $("#txt").val()});
//                        });
//                    }); //fin document ready
        </script>