<?php
session_start();
//initialisation des variables
//$cookiepwd = "";
//$cookielog = "";
//$_POST['pwd']="";
//$_POST['login']="";
$admin = "";
require('chargeurClass.php');
//chargement de la connexion
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
//verificatin formulaire
if (isset($_POST['veriflog'])) {
    //creation du cookie login et nomAdmin date d'expiration dans 1an
    $securisationLog = securisation($_POST['login']);
    $cookieLog = $_COOKIE['cookielog']; //on créer une variable qui possède le contenu du champ login
    setcookie('cookielog', $securisationLog, time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    $securisationAdmin = securisation($_POST['nomAdm']);
//    $cookienomAdm = ' ' . $securisationAdmin . ' '; //on créer une variable qui possède le contenu du champ login
    setcookie('cookienomAdm', $securisationAdmin, time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//    var_dump($_POST);

    if (!!($_POST['login']) && !!($_POST['nomAdm'])) {
        $form['login'] = securisation($_POST['login']);
        $form['nomAdm'] = securisation($_POST['nomAdm']);
        //on verifie que le login n'est pas deja dans la base
        $LogAdmin = new Admin($form);
        $verificationLog = $manager->AdminControleLog($LogAdmin);
        if ($verificationLog) {
//              var_dump($_POST);
//            var_dump($verificationLog);
//            var_dump($LogAdmin);
//            var_dump($manager);
            $messageLoginExiste = "le login :  $cookieLog, existe déjà dans la base, veuillez en saisir un autre ";
        } else {
            // echo ' login ok ';
            header("location: adminInscriptionSuite.php");
        }
    } //fin fonction fomulaire isset log  
}////fin fonction fomulaire test !! login
//              }//fin fonction fomulaire isset veriflog
//var_dump($form);
//var_dump($_POST);
//var_dump($db);
//var_dump($_SESSION);
//var_dump($_SERVER);
//var_dump($_COOKIE);
?>
<!--
Cette page permet de rajouter des administrateurs dans la base de donnée, 
elle  est protégée par le fichier .htaccess et .htpwd se trouvant dans le repertoire log
Elle verifie que les données du formulaire sont ok et crypte le mot de passe
-->
<?php include("header.php"); ?>
<!doctype html>
<html>
    <head>
        <title>Page login administrateur</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">-->
        <!--<link rel="stylesheet" href="style/styleFormulaire.css"  type="text/css" charset="utf_8"/>-->
        <link rel="stylesheet" href="style/formulaireLoginAdminBootstrap.css"  type="text/css" charset="utf_8"/>
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--<script src="style/jqueryFiles/jquery-3.2.1.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
 <main id="content" class="col-9 col-md-9">
        <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
        <div class="bootstrap-iso">
            <!-- <div class="container-fluid"> -->

            <div class="well">
                <div class="row">
                    <!--titre-->
                    <div class="col-8">
                        <h1>Inscrivez un nouvel Administrateur ci-dessous :</h1>
                        <p>Tous les champs marqués d'une <span class="asteriskField">*</span> sont obligatoires</p>
                    </div>
                    <div class="col-4">
                        <!--zone pour integrer les messages de retour-->        
                        <div id="message_retour" >               
                            <p> 
                                <?php
//                                echo (isset($messageinscrit)) ? $messageinscrit : "";
//                                echo (isset($messageMail)) ? $messageMail : "";
//                                echo (isset($messageReglement)) ? $messageReglement : "";
//                                echo (isset($messageMajeur)) ? $messageMajeur : "";
//                                echo (isset($messagePerdu)) ? $messagePerdu : "";
//                                echo (isset($messageGagne)) ? $messageGagne : "";
//                                echo (isset($messageDejaJoueToday)) ? $messageDejaJoueToday : "";
//                                echo (isset($messageChampFormulaire)) ? $messageChampFormulaire : "";
                                echo (isset($messageLoginExiste)) ? $messageLoginExiste : "";
//                                echo (isset($messageConfirmationMotPasse)) ? $messageConfirmationMotPasse : "";
                                ?>
                            </p>
                        </div><!--fin messages retour-->

                    </div>

                </div>

                <form method="post" action="adminInscription.php" onsubmit="return verifForm(this)">
                    <div class="row">
                        <!--nom et prenom-->
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class="form-group ">
                                <label class="control-label requiredField" for="nom">Nom<span class="asteriskField">*</span></label>
                                <input class="form-control" id="nomAdm" name="nomAdm" type="text" placeholder="votre nom...." minlength="2" maxlength="48" onblur="verifNom(this)" required/>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="login">login<span class="asteriskField"> * </span></label>
                                <input class="form-control" id="login" name="login" type="text" placeholder="votre login...." minlength="2" maxlength="48" onblur="verifPrenom(this)" required/>
                            </div>
                        </div>
                    </div>
                    <div id="espace"> </div>
                    <div id="espace2"> </div>
                    <div class="col-12 text-center mt-5">
                        <div class="form-group">
                            <div>
                                <button class="btn btn-primary " name="veriflog" type="submit">Suivant</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
 </main>
        <script>

            //function qui change le fond en rouge si erreur de saisie d'un champ
            function surligne(champ, erreur)
            {
                if (erreur)
                    champ.style.backgroundColor = "#fba";
                else
                    champ.style.backgroundColor = "";
            }


//function de verification du champ nom
            function verifNom(champ)
            {
                if (champ.value.length < 2 || champ.value.length > 25)
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
//function de verification du champ login
            function verifPrenom(champ)
            {
                if (champ.value.length < 2 || champ.value.length > 25)
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
                {
                    surligne(champ, true);
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
                var nomOk = verifNom(f.nom);
                var loginOk = verifLogin(f.login);

                if (nomOk && loginOk)
                    return true;
                else
                {
                    alert("Veuillez remplir correctement tous les champs");
                    return false;
                }
            }


            //        controle de saisie dynamique du champ login afin de verifier qu'il n'existe pas
            //         deja dans la base, réalisé en AJAX
            $(document).ready(
                    function () {
                        $("#txt").keyup(function () {
                            $("#login").load("classes/AdminManager.php", {q: $("#txt").val()});
                        });
                    }); //fin document ready
        </script>
    </body>
    <?php include("footer.php"); ?>
</html>