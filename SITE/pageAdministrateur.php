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


$jeuComptage = new AdminJeu();
//var_dump($jeuComptage);
//var_dump($manager->countgagnants());
$jeuComptage->setCount_gagnants($manager->countgagnants());
//var_dump($jeuComptage);
$jeuComptageclients = new AdminJeu();
//var_dump($jeuComptage);
//var_dump($manager->countgagnants());
$jeuComptageclients->setCount_clients($manager->countclients());
//var_dump($jeuComptage);

$gagnant = new AdminJeu();
$clients = new AdminJeu();
$gagnant->setGagnants($manager->listegagnants());
//var_dump($gagnant);
$gagantscsv = new AdminJeu();
$gagantscsv -> getCreatecsv($gagantscsv);
$participantscsv = new AdminJeu();
$participantscsv -> getCreatecsvparticipants($participantscsv);

//$jeuComptage->setGagnants($manager->listegagnants());

if (isset($_POST['date_debut_jeu']) && isset($_POST['date_fin_jeu']) ) {
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
    echo "bravo vous avez entre un nouveau jeu";
}



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



if (isset($_POST['sujet']) && isset($_POST['msg'])&& isset($_POST['gagnantscoche'])) {//  !! permet de verifier tous les paramétres(isset, !empty, NOT NULL ...)
    $objet = $_POST['sujet'];
    $message = $_POST['msg'];
////Envoi de mail apr�s inscriptions
    // On s�curise l'adresse mail destinataire
    // On s�curise l'adresse mail destinataire

    $mailsafariz = 'lejeusafariz@gmail.com';

    foreach($_POST['gagnantscoche'] as $mail)
    {
        $destinataires = $mail.',';
    }

    //  $destinataire = echo

// Pour les champs $expediteur / $copie / $destinataire, s�parer par une virgule s'il y a plusieurs adresses
//            $expediteurmail = $mail;
//            $expediteurnom = $nom . " " . $prenom;


    $headers = 'MIME-Version: 1.0' . "\r\n"; // Version MIME
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // l'en-tete Content-type pour le format HTML
    $headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
    $headers .= 'To: Safariz <' . $destinataires . '>' . "\r\n"; // Mail de reponse
    $headers .= 'X-Mailer: PHP/' . phpversion() . "\r\n";
    $headers .= 'X-Priority: 1' . "\r\n";
    $headers .= 'From: <' . $mailsafariz . '>' . "\r\n"; // Expediteur
    $headers .= 'Reply-to: <' . $mailsafariz . '>' . "\r\n"; // Expediteur
    $headers .= 'Message: ' . $message . "\r\n"; // Expediteur

    //  $message = '<html><body>' . $msg . '</body></html>';
    mail($destinataires, $objet, $message, $headers);

    $confirm = "Vous avez envoye ".count($_POST['gagnantscoche'])." messages aux destinataires suivants : <br>$destinataires";

}



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
    <h1>Section Administrateur</h1>
    <div class="container-fluid">
        <div class="well">

            <!--                 <div class="well">-->
            <div class="row" ><!--titre-->
                <div class="col-md-6 col-sm-6 col-xs-12">

                    <h2>Créer un jeu</h2>
                    <H3> Rentrez vos  dates de début et de fin de jeu pour un nouveau jeu</H3>

                </div>
            </div>



            <form method="post" name="admin" action="">
                <div class="form-group ">
                    <label class="control-label requiredField" for="nom">date et heure de début du Jeu<span class="asteriskField">*</span></label>
                    <input class="form-control" id="nom" name="date_debut_jeu"   type="datetime-local" placeholder="2017-11-01 00:00:00"  maxlength="48"/>
                </div>
                <div class="form-group ">
                    <label class="control-label requiredField" for="nom">date et heure de Fin de Jeu<span class="asteriskField">*</span></label>
                    <input class="form-control" id="nom" name="date_fin_jeu"   type="datetime-local" placeholder="2017-11-01 00:00:00"  maxlength="48"/>
                </div>

                <div class="form-group">
                    <div>
                        <button class="btn btn-primary " name="bouton" type="submit">Ajouter un jeu</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="well">
            <h2>Vos statistiques</h2>


<?php /*
// 3 façons de concaténer du html et du php
            <?php echo "<div>".$toto."</div>"; ?>

            <?php echo "<div>$toto</div>"; ?>

            <div>
                <?php echo $toto; ?>
            </div>


            */ ?>


            <?php
           echo '<table class="table table bordered">
                <tr><th>Nombre de gagnants</th><th>Nombre de clients</th><th>Stats</th></tr> <tr><td><font size="50"> '.$jeuComptage->getCount_gagnants().'</td><td><font size="50"> '.$jeuComptageclients->getCount_clients().' </td><td><font size="50">Vos stats</td></tr></table>';
            // $jeuComptage->getCount_gagnants(); c'est la valeur de l'objet :  je fais passer l'objet dans la methode.
            ?>

        </div>

        <div class="well">
            <h2>Envoi d'un email aux gagnants</h2>
            <h3>Selectionnez vos destinataires</h3>
            <?php

            echo '<div class="table-responsive"> <form name="gagnants" method="post">
                       <script> $(document).ready(function() {
    $(\'#example\').DataTable(); } ); </script> <table class="table table bordered">
                        <tr><th>Selection</th><th>Nom</th><th>Prenom</th><th>Mail</th><th>Lot</th><th>Date gain</th></tr>';
            foreach ($gagnant->getGagnants() as $gagnant) {
                echo '<tr><td> <input type="checkbox" name="gagnantscoche[]" value="'.$gagnant['mail'].'"/></td><td>' . $gagnant['nom'] . '</td><td>' . $gagnant['prenom'] . '</td><td>' . $gagnant['mail'] . '</td><td>' . $gagnant['label'] . '</td><td>' . $gagnant['dateGain']. '</td></tr>';
            }
            echo ' <tr><td colspan="4"> </td></tr> </table> </div>';

          //  var_dump($_POST);
            ?>


        </div>
        <div class="well">
            <h2>Envoyer des emails aux gagnants cochés</h2>

            <div class="form-group ">
                <label class="control-label requiredField" for="sujet">Sujet<span class="asteriskField"></span></label>
                <input class="form-control" id="sujet" name="sujet"   type="text" placeholder="votre sujet...."  maxlength="48"/>
            </div>
            <div class="form-group ">
                <label class="control-label requiredField" for="msg">Votre message<span class="asteriskField"></span></label>
                <textarea  class="form-control" id="msg" name="msg" ></textarea>

                <div class="form-group ">

                </div>
                <div class="row">
                    <div id="espace"> </div>
                    <div class="form-group">
                        <div style="padding:20px;">
                          <button class="btn btn-primary " name="bouton" type="submit">Envoyer le message</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <?php echo (isset($confirm)?$confirm:"") ; ?>

            <div class="well">
                <h2>Extractions des fichiers gagnants et clients en CSV</h2>
                <h3>Gagnants</h3>
            <a href="gagnants.csv"> Télécharger votre fichier gagnants</a>
                <h3>Clients</h3>
            <a href="participants.csv"> Télécharger votre fichier participants</a>
            </div>

        </div>
    </div>
</body>
</html>



