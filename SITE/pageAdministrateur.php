<?php
session_start();


//chargement des classes
require('chargeurClass.php');
require('connexionBD.php');
//require('admin.php');
$db = connexionDB();

//nouvel objet de la classe adminManagerjeu instancié 
//par les attributs de la connexionDB() à la base donnée mysql
$manager = new AdminManagerJeu($db);

date_default_timezone_set("Europe/Paris");

// champs base de donnée client_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,ip, newsLetterInscription
// champs formulaire  nom  prenom tel mail adresse  ville cp   majeur reglement  newsletter 
//initialisation de la variable $form en tableau, cette variable se charge de stocker des valeurs du formulaire
//afin de les utiliser dans notre objet new Client($form), grace à notre hydratation
$form = array();
//var_dump($_POST);
//*************************************************************************************


if (isset($_POST['date_debut_jeu']) && isset($_POST['date_fin_jeu'])) {
    $form['date_debut_jeu'] = $_POST['date_debut_jeu'];
    $form['date_fin_jeu'] = $_POST['date_fin_jeu'];


    $form['ip'] = $_SERVER['REMOTE_ADDR']; // stocke l'adresse IP
    $form['session_id'] = $_COOKIE['PHPSESSID']; // stocke l'id de session
    //la fonction isValidFormulaire
    // avant d'envoyer les données formulaire dans la base nous verifions que les formats nom adresse cp ...sont conformes
    
 //   var_dump($form);
    //nouvel objet  $client de la classe client prenant les valeurs du tableau $form
    $jeu = new AdminJeu($form);
   // var_dump($jeu);
    $manager->addJeux($jeu);  //inscription dans la base . On affecte les valeurs  de la fonction addJeu avec l'objet $jeu en argument à l'objet $manager
    echo "bravo vous avez entr� un nouveau jeu";
} else {
    echo 'erreur de saisie du formulaire'; // gestion des erreurs en php
}

echo ' </br>formulaire ok </br>';

//    var_dump($client);
//}
//else {
//   echo "veuillez accepter le réglement et confirmer que vous êtes majeur"; 
//fin fonction  formulaire
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
//var_dump($db);
//var_dump($_SESSION);
//var_dump($_SERVER);
//var_dump($_COOKIE);
?>
<!DOCTYPE html>
<!--
formulaire d'inscription 
-->
<html>
    <head>
        <title>Page administrateur</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" href="style/styleFormulaire.css"  type="text/css" charset="utf_8"/>
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--<script src="style/jqueryFiles/jquery-3.2.1.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />


    </head>

    <body class="container" >

        <div class="bootstrap-iso">
            <div class="container-fluid"> 
                <div class="well">
                    <!--                 <div class="well">-->
                    <div class="row" ><!--titre-->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h1>Section Administrateur</h1>
                            <p> Rentrez ici vos  dates de d�but et de fin de jeu pour votre nouveau jeu</p>

                        </div>
                    </div>



                    <form method="post" name="admin" action="">
                        <div class="form-group ">
                            <label class="control-label requiredField" for="nom">date et heure de d�but du Jeu<span class="asteriskField">*</span></label>
                            <input class="form-control" id="nom" name="date_debut_jeu"   type="text" placeholder="2017-11-01 00:00:00"  maxlength="48"/>
                        </div>
                        <div class="form-group ">
                            <label class="control-label requiredField" for="nom">date et heure de Fin de Jeu<span class="asteriskField">*</span></label>
                            <input class="form-control" id="nom" name="date_fin_jeu"   type="text" placeholder="2017-11-01 00:00:00"  maxlength="48"/>
                        </div>

              

                <div class="form-group">
                    <div>
                        <button class="btn btn-primary " name="bouton" type="submit">Ajouter un jeu</button>
                    </div>
                </div>    
                </form>
            </div>
        </div>
        <script type="text/javascript">
            

                //fonction de controle de saisie du formulaire

                function testerdate(date_debut_jeu) { 
                }

 
    


        </script>

    </body>
</html>



