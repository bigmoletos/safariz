<?php
session_start();
//initialisation des variables
//$cookiepwd = "";
//$cookielog = "";
//$_POST['pwd']="";
//$_POST['login']="";
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
    $securisationLog = securisation($_POST['login']);
    $cookielog = ' ' . $securisationLog . ' '; //on créer une variable qui possède le contenu du champ login
    setcookie('cookielog', ' ' . $cookielog . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    $securisationAdmin = securisation($_POST['nomAdm']);
    $cookienomAdm = ' ' . $securisationAdmin . ' '; //on créer une variable qui possède le contenu du champ login
    setcookie('cookienomAdm', ' ' . $cookienomAdm . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    //  var_dump($cookienomAdm);
    //  var_dump($cookielog);

    if (!!($_POST['login']) && !!($_POST['nomAdm'])) {
        $form['login'] = securisation($_POST['login']);
        $form['nomAdm'] = securisation($_POST['nomAdm']);
        $LogAdmin = new Admin($form);
        $verificationLog = $manager->addAdmincontrolelog($LogAdmin);
        //version Ajax
        $verificationLogAjax = $manager->verifLoginAjax($LogAdmin);

        //      var_dump($form);
        //  var_dump($_POST);
        //     var_dump($verificationLog);
        //     var_dump($LogAdmin);
        //      var_dump($manager);
        // $nblog-> getLogin();
        //      var_dump($nblog);
        if (is_null($verificationLog)) {
            echo ' login existe deja';
        }
        if ($verificationLog === FALSE) {
            echo ' login ok ';
            header("location: adminInscriptionSuite.php");
        }

        //********integrer ci desssous le formulaire en 2 étapes une pour verifier que le login n'existe pas deja
//                     si c'est le cas on affiche la suite du formulaire avec les zones mot de passe et confirmation mot de passe'
//        if (isset($_POST['log'])) {
//            if (!!($_POST['pwd']) && !!($_POST['confirmpwd'])) {
//                $form['password'] = securisation($_POST['pwd']);
//                $confirmpwd = securisation($_POST['confirmpwd']);
//                if (!!($_POST['nomAdm']) && !!($_POST['email'])) {
//
//                    if ($form['password'] == $confirmpwd) {
//
//                        $form['nomAdm'] = securisation($_POST['nomAdm']);
//                        $form['email'] = securisation($_POST['email']);
//                        $form['dateLastConnexion'] = ($_SERVER['REQUEST_TIME']);
//                        // cryptage du mot de pwd par un hachage en md5
//                        //        $form['password'] = md5($form['password']);
//                        $form['password'] = password_hash($form['password'], PASSWORD_DEFAULT);
        //     $form['confirmpwd'] = md5($form['confirmpwd']);
        //    var_dump($form['login']);
        //  var_dump($form['nomAdm']);
        //   var_dump($form['email']);
        //   var_dump($form['password']);
        //  var_dump($_SERVER);
        //   var_dump($form);
        //mysql_query("INSERT INTO validation VALUES('', '$login', '$pwd', '$email')");
        //nouvel objet  $admin de la classe admin prenant les valeurs du tableau $form
        //        $admin = new Admin($form);
        //on affecte les valeurs  de la fonction addAdmin avec l'objet $admin en argument à l'objet $manager
        //         $manager->addAdmin($admin);
        //       }//fin login nomadm email 
        ////      else {
        //  echo '<br>Les deux mots de passe que vous avez rentrés ne correspondent pas…<br>';
        //          }
        //          echo ' <br>formulaire ok<br>';
        // header("Location: pageAministrateur.php");
        //   var_dump($admin);
        // } //fin verif confirmation 
        else {
            echo ' <br>formulaire incomplet veuillez entrer le login<br>';
        }
        echo '<br>trop nul ton  formulaire est incomplet veuillez verifier les champs<br>';
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
<!doctype html>
<html>
    <head>
        <title>Page login</title>
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
    </head>
    <body>

        <!-- HTML Form (wrapped in a .bootstrap-iso div) -->
        <div class="bootstrap-iso">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <h2>Inscription administrateur </h2>
                        <form method="post" action="inscriptionAdmin.php">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="nom">
                                    NOM
                                    <span class="asteriskField">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="nomAdm" name="nomAdm" placeholder="votre nom..." type="text"/>
                            </div>
                            <div class="form-group ">
                                <label class="control-label requiredField" for="prenom">
                                    LOGIN
                                    <span class="asteriskField">
                                        *
                                    </span>
                                </label>
                                <input class="form-control" id="login" name="login" placeholder="votre login..." type="text"/>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary btn-lg"  id="veriflog" name="veriflog" type="submit">Suivant</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>






        <script>
            //        controle de saisie dynamique du champ login afin de verifier qu'il n'existe pas
            //         deja dans la base, réalisé en AJAX  utilisant function verifLogin(Admin $admin)
//     $LogAdmin = new Admin($form);
            //      $verificationLog= $manager->verifLoginAjax($LogAdmin);

//     instanciation objet xkr (XMLHttpRequest)        
            var xhr = new XMLHttpRequest();
//     préparation  requête afin que cette dernière contacte la page ajax.php sur le nom de domaine 
//     mon_site_web.com par le biais du protocole http (vous pouvez très bien utiliser d'autres protocoles, 
//     comme HTTPS ou FTP par exemple). Tout paramètre spécifié à la requête sera transmis 
//     par le biais de la méthode GET.
            xhr.open('GET', 'http://mon_site_web.com/ajax.php');
//        envoie de la requete
            xhr.send(null);
            
            
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  
  xhttp.open("GET", "ajax_info.txt", true);
  xhttp.send();
}



            $(document).ready(
                    function () {
                        $("#txt").keyup(function () {
                            $("#word").load("classes/AdminManager.php", {q: $("#txt").val()});
                        });
                    }); //fin document ready
        </script>
    </body>
</html>