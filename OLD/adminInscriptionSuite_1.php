<?php
session_start();
//initialisation des variables
//$cookiepwd = "";
//$cookielog = "";
//$_POST['pwd']="";
//$_POST['login']="";
$admin = "";
//creation du cookie password autopwd date d'expiration dans 5 min
if (isset($_POST['log'])) {
    $cookiepwd = ' ' . $_POST['pwd'] . ' '; //on créer une variable qui possède le contenu du champ login
    setcookie('autopwd', ' ' . $cookiepwd . ' ', time() + 5 * 60, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
}
//creation du cookie login autologin? date d'expiration dans 1an
//$cookielog = ' ' . $_POST['login'] . ' '; //on créer une variable qui possède le contenu du champ login
//setcookie('autologin', ' ' . $cookiepwd . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
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

//var_dump($_COOKIE);
//var_dump($cookienomAdm);
//var_dump($cookielog);
$form = array();
$loginAdministrateur = $_COOKIE['cookielog'];
$nomAdministrateur = $_COOKIE['cookienomAdm'];
//var_dump($nomAdministrateur);
//var_dump($loginAdministrateur);
//var_dump($_POST);
//********integrer ci desssous le formulaire en 2 étapes une pour verifier que le login n'existe pas deja
//                     si c'est le cas on affiche la suite du formulaire avec les zones mot de passe et confirmation mot de passe'
if (isset($_POST['log'])) {
    if (!!($_POST['pwd']) && !!($_POST['confirmpwd'])) {
        $form['password'] = securisation($_POST['pwd']);
        $confirmpwd = securisation($_POST['confirmpwd']);
        if (!!($_POST['email'])) {

            if ($form['password'] == $confirmpwd) {
                $form['login'] = $loginAdministrateur;
                $form['nomAdm'] = $nomAdministrateur;
                $form['email'] = securisation($_POST['email']);
                $form['dateLastConnexion'] = ($_SERVER['REQUEST_TIME']);
                // cryptage du mot de pwd par un hachage en md5
                //        $form['password'] = md5($form['password']);
                $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);
                // var_dump($form['login']);
                // var_dump($form['nomAdm']);
                //   var_dump($form['email']);
                //   var_dump($form['password']);
                //  var_dump($_SERVER);
                //  var_dump($form);
                //mysql_query("INSERT INTO validation VALUES('', '$login', '$pwd', '$email')");
                //nouvel objet  $admin de la classe admin prenant les valeurs du tableau $form
                $admin = new Admin($form);
                //on affecte les valeurs  de la fonction addAdmin avec l'objet $admin en argument à l'objet $manager
                $manager->addAdmin($admin);
            }//fin verif confirmation  
            else {
                //  echo '<br>Les deux mots de passe que vous avez rentrés ne correspondent pas…<br>';
            }
            echo ' <br> les mots de passe sont différents<br>';
            // header("Location: pageAministrateur.php");
            //   var_dump($admin);
        }  //fin login email
        else {
            echo ' <br>veuillez saisir une adresse mail valide<br>';
        }
    }
    echo '<br>veuillez saisir un mot de passe et le confirmer<br>';

    //       } //fin fonction fomulaire isset log  
    //       }////fin fonction fomulaire test !! login
}//fin fonction fomulaire isset veriflog
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
        <title>Page login administrateur suite</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">-->
        <!--<link rel="stylesheet" href="style/styleFormulaire.css"  type="text/css" charset="utf_8"/>-->
        <link rel="stylesheet" href="style/formulaireLoginAdminbootstrap.css"  type="text/css" charset="utf_8"/>
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

        <!-- integration formulaire de Franck -->
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
//                                echo (isset($messageLoginClient)) ? $messageLoginClient : "";
//                                echo (isset($messageConfirmationMotPasse)) ? $messageConfirmationMotPasse : "";
                                ?>
                            </p>
                        </div><!--fin messages retour-->

                    </div>
                    
                </div>
                <form method="post" name="inscriptionAdmin" id='inscriptionAdmin'  onsubmit="return verifForm(this)">
                    <!--<form method="post" name="inscription" id='inscription' action="jeusafariz.php">-->

                    <div class="row">
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='mail' for="mail"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="email" name="email" type="email"  placeholder="xxx@xxx.xx"  minlength="6" maxlength="48" onblur="verifMail(this)" required/>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='passwordA' for="password" > Mot de passe </label>
                                    <!--<span class="asteriskField"> * </span></label>-->

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                        </div>
                                        <input class="form-control" id="pwd" name="pwd" type="password" placeholder="votre mot de passe..." minlength="5" maxlength="48" onblur="return verifPassword(this)"/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='confirmpwdA' for="confirmpwd" > Confirmation mot de passe </label> 
                                    <!--<span class="asteriskField"> * </span></label>-->

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                        </div>
                                        <input class="form-control" id="confirmpwd" name="confirmpwd" type="password" placeholder="votre mot de passe..."  minlength="5" maxlength="48" onblur="return verifConfirmPassword2(this)"/>
                                    </div>
                            </div>
                        </div>
                    </div>  

                    <div id="espace"> </div>
                    <!--espace entre bouton et reglement-->

                    <div class="row">

                        <!--</div>-->
                        <!--<br/><br/><div class="row">bouton validation-->

                        <div class="col-12 text-center mt-5">
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary " name="log" type="submit">Valider l'inscription</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--</div> container.fluid-->

        <!-- fin formulaire de Franck -->

    </main>
    <!-- content -->
<!--</section>-->


        <script>
            //        controle de saisie dynamique du champ login afin de verifier qu'il n'existe pas
            //         deja dans la base, réalisé en AJAX
            //         
            //         
     
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
    
    //function de verification du champ  confirmpassword
    function verifConfirmPassword2(champ)
{  
   if(champ.value != document.getElementById('pwd').value)
   {
      document.getElementById("confirmpwdA").innerHTML = "vos mots de passe sont différents veuillez les ressaisir";
//      confirmpwd.setCustomValidity("vos mots de passe sont différents veuillez les ressaisir");
//            alert("MDP different");
      surligne(champ, true);
      return false;
   }
   else
   {
      document.getElementById("confirmpwdA").innerHTML = "vos mots de passe sont identiques ";
//            alert("MDP similaire");
      surligne(champ, false);
      return true;
   }
}
    
      //verif complete des champs du formulaire
    function verifForm(f)
    {
        var mailOk = verifMail(f.email);
        var verifConfirmPasswordOk= verifConfirmPassword2(f.confirmpwd)
        var verifPasswordOk= verifPassword(f.pwd)

        if (mailOk && verifPasswordOk && verifConfirmPasswordOk )
            return true;
        else
        {
            alert("Veuillez remplir correctement tous les champs");
            return false;
        }
    }
    
    
    
    $(document).ready(
                    function () {
                        $("#txt").keyup(function () {
                            $("#word").load("classes/AdminManager.php", {q: $("#txt").val()});
                        });
                    }); //fin document ready
        </script>
    </body>
         <?php include("footer.php"); ?>
</html>