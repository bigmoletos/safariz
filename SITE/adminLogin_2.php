<?php
session_start();

//initialisation des variables
//$cookiepwd = "";
//$cookielog = "";
//$_POST['pwd']="";
//$_POST['password']="";
$admin = "";
//creation du cookie password autopwd date d'expiration dans 5 min
//$cookiepwd = ' ' . $_POST['pwd'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('cookiepwd', ' ' . $cookiepwd . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//creation du cookie login autologin? date d'expiration dans 1an
//$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('cookielog', ' ' . $cookielog . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
//chargement des classes
require('chargeurClass.php');
//chargement de la connexion
// a enlever si l'autoload fonctionne
//require ('classes/AdminManager.php');
//require ('classes/Admin.php');

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
if (isset($_POST['veriflog'])) {
    //creation du cookie login autologin? date d'expiration dans 1an
    $securisationLog = securisation($_POST['password']);
    $cookielog = ' ' . $securisationLog . ' '; //on créer une variable qui possède le contenu du champ password
    setcookie('cookielog', ' ' . $cookielog . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    $securisationAdmin = securisation($_POST['mailAdmin']);
    $cookiemailAdmin = ' ' . $securisationAdmin . ' '; //on créer une variable qui possède le contenu du champ password
    setcookie('cookiemailAdmin', ' ' . $cookiemailAdmin . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    //  var_dump($cookiemailAdmin);
    //  var_dump($cookielog);

    if (!!($_POST['password']) && !!($_POST['mailAdmin'])) {
        $form['password'] = securisation($_POST['password']);

        $form['email'] = securisation($_POST['mailAdmin']);
        $LogAdmin = new Admin($form);
        $verificationLog = $manager->adminLogin($LogAdmin);
        //     var_dump($verificationLog);
        $hash = $verificationLog['password'];
        $nomAdm = $verificationLog['nomAdm'];
        $login = $verificationLog['login'];
        //    var_dump($hash);
        if (password_verify($form['password'], $hash)) {

            //   echo "mot de passe ok Bonjour $prenom $nom  nous vous souhaitons bonne chance!</br>";
            $messageLoginAdmin = "Bonjour $login nous vous souhaitons une bonne journée!</br>  ";
            $cookiemessageLoginAdmin = $messageLoginAdmin;
            setcookie('messageLoginAdmin', ' ' . $cookiemessageLoginAdmin . ' ', time() + 5 * 60, null, null, false, true);
            // var_dump($cookiemessageLoginAdmin);

            header("location:pageAdministrateur.php");
        } else {
            echo 'mot de passe incorrect veuillez le ressaisir';
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
<!--
Cette page permet de rajouter des administrateurs dans la base de donnée, 
elle  est protégée par le fichier .htaccess et .htpwd se trouvant dans le repertoire log
Elle verifie que les données du formulaire sont ok et crypte le mot de passe
-->
<!doctype html>
<html>
    <head>
        <title>Page login joueur</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">-->
        <!--<link rel="stylesheet" href="style/styleFormulaire.css"  type="text/css" charset="utf_8"/>-->
        <link rel="stylesheet" href="style/formulaireLoginClientBootstrap.css"  type="text/css" charset="utf_8"/>
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

        <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
        <div class="bootstrap-iso">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <h2>Login administrateur </h2>
                        <form method="post" action="adminLogin.php">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="nom">
                                    Mail
                                    <span class="asteriskField">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="mailAdmin" name="mailAdmin" placeholder="votre mail..." type="text" required/>
                            </div>
                            <div class="form-group ">
                                <label class="control-label requiredField" for="prenom">
                                    Mot de passe
                                    <span class="asteriskField">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="password" name="password" placeholder="votre password..." type="password" required/>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary btn-lg"  id="veriflog" name="veriflog" type="submit">ok</button>
                                </div>
                            </div>

                            <a href="adminInscription.php"/>inscription nouvel administrateur</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>






        <script>
            //        controle de saisie dynamique du champ password afin de verifier qu'il n'existe pas
            //         deja dans la base, réalisé en AJAX
            $(document).ready(
                    function () {
                        $("#txt").keyup(function () {
                            $("#password").load("classes/AdminManager.php", {q: $("#txt").val()});
                        });
                    }); //fin document ready
        </script>
    </body>
</html>