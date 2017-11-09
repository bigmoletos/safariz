<?php
session_start();
//initialisation des variables
$cookiepwd = "";
$cookielog = "";
//$_POST['pwd']="";
//$_POST['login']="";
$admin = "";
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

if (isset($_POST['logAdmin'])) {
    //if (isset($_POST['log'])) {
    if (!!($_POST['login']) && !!($_POST['pwd'])) {
        $form['password'] = securisation($_POST['pwd']);
        $form['login'] = securisation($_POST['login']);

        // cryptage du mot de pwd par un hachage en md5
        //        $form['password'] = md5($form['password']);
        $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);
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
        var_dump($admin);
        //on affecte les valeurs  de la fonction connectAdmin avec l'objet $admin en argument à l'objet $manager
        $verif = $manager->connectAdmin($admin);
        var_dump($verif);
    }//fin login nomadm email 
    else {
        echo 'erreur de login ou de mot de passe…';
    }
    echo ' formulaire ok';
    var_dump($admin);
}//fin fonction fomulaire isset



var_dump($form);
var_dump($_POST);
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
        <title>Page login</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">-->
        <!--<link rel="stylesheet" href="style/styleFormulaire.css"  type="text/css" charset="utf_8"/>-->
        <link rel="stylesheet" href="style/logadmin.css"  type="text/css" charset="utf_8"/>
        <!--        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
                <script src="style/jqueryFiles/jquery-3.2.1.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
                <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
                <script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
                <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">-->
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
    </head>
    <body>

        <!--<div class = "container">
                <div class="wrapper">
                        <form action="" method="post" name="Login_Form" class="form-signin">       
                            <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
                                  <hr class="colorgraph"><br>
                                  
                                  <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
                                  <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>     		  
                                 
                                  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
                        </form>			
                </div>
        </div>-->

        <div class = "container">
            <div class="wrapper">
                <form action="" method="post" name="Login_Form" class="form-signin">       
                    <h3 class="form-signin-heading">Bienvenue! merci de vous enregistrer</h3>
                    <hr class="colorgraph"><br>

                    <form name="logAdmin" class="form-control" action="loginAdmin.php" method="post">
                        <label>Login: <input type="text"  id="login" name="login"/></label><br/>
                        <label>Mot de pwd: <input type="password" class="form-control" id="pwd" name="pwd"/></label><br/>
                        <!--<input type="submit"  id="logAdmin" name="logAdmin" value="connexion"/>-->
                        <button class="btn btn-lg btn-primary btn-block"  name="logAdmin" value="connexion" type="Submit">Login</button>
                    </form>

                </form>			
            </div>
        </div>                   


        <script>
            //        controle de saisie dynamique du champ login afin de verifier qu'il n'existe pas
            //         deja dans la base, réalisé en AJAX
            $(document).ready(

            }); //fin document ready
        </script>
    </body>
</html>