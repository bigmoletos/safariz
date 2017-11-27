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
            $messageverifMotPasse= 'mot de passe incorrect veuillez le ressaisir';
//            echo 'mot de passe incorrect veuillez le ressaisir';
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
<?php include("header.php"); ?>
<!--
Cette page permet de rajouter des administrateurs dans la base de donnée, 
elle  est protégée par le fichier .htaccess et .htpwd se trouvant dans le repertoire log
Elle verifie que les données du formulaire sont ok et crypte le mot de passe
-->
<!doctype html>
<html>
    <head>
        <title>Page login administrateur</title>
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
        <main id="content" class="col-12 col-md-9">

            <div class="bootstrap-iso">
                <!-- <div class="container-fluid"> -->

                <div class="well">
                    <div class="row">
                        <!--titre-->
                        <div class="col-12">
                            <h2>Pour vous connecter veuillez saisir votre login et votre mot de passe Administrateur </h2>
                            <p>Tous les champs marqués d'une <span class="asteriskField">*</span> sont obligatoires</p>
                        <!--</div>-->
                        <div class="col-12 col-md-6">
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
//                                echo (isset($messageLoginExiste)) ? $messageLoginExiste : "";
                                echo (isset($messageverifMotPasse)) ? $messageverifMotPasse : "";
                                    ?>
                                </p>
                            </div><!--fin messages retour-->

                        </div>

                    </div>

                    <form method="post" action="adminLogin.php" onsubmit="return verifForm(this)">
                        <div class="row">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="form-group ">
                                    <label class="control-label requiredField" id='mail' for="mail"> Email <span class="asteriskField"> * </span></label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                        </div>
                                        <input class="form-control" id="mailAdmin" name="mailAdmin" type="email"  placeholder="xxx@xxx.xx"  minlength="6" maxlength="48" onblur="verifMail(this)" required/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <div class="form-group ">
                                    <label class="control-label requiredField" id='passwordA' for="password" > Mot de passe </label>
                                        <!--<span class="asteriskField"> * </span></label>-->

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                        </div>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="votre mot de passe..." minlength="5" maxlength="48" onblur="return verifPassword(this)"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="espace"> </div>
                        <!--espace entre bouton et reglement-->
                        <div class="row">
                            <div class="col-12 text-center mt-5">
                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary " name="veriflog" type="submit">Suivant</button>
                                    </div>
                                </div>
                            </div>
                         </div>
                        </div>
                    </form>
                      <a href="adminInscription.php"/>inscription nouvel administrateur</a>
                </div>
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

            //function de verification du champ mail
            function verifMail(champ)
            {
                var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
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


//function de verification du champ  password
            function verifPassword(champ)
            {
                if (champ.value.length < 5 || champ.value.length > 25)
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
                var mailOk = verifMail(f.email);
                var verifPasswordOk = verifPassword(f.password)

                if (mailOk && verifPasswordOk)
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