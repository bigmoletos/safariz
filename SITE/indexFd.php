<?php
session_start();


//chargement des classes
//require('chargeurClass.php');
//chargement de la connexion
// a enlever si l'autoload fonctionne
require ('classes/clientManager.php');
require ('classes/client.php');

require('connexionBD.php');
//require('admin.php');
$db = connexionDB();

//nouvel objet de la classe ClientManager instancié 
//par les attributs de la connexionDB() à la base donnée mysql
$manager = new ClientManager($db);

date_default_timezone_set("Europe/Paris");

// champs base de donnée client_id, nom,  prenom, mail, adresse, cp, ville, tel, dateInscription,session_Id,ip, newsLetterInscription
// champs formulaire  nom  prenom tel mail adresse  ville cp   majeur reglement  newsletter 
//initialisation de la variable $form en tableau, cette variable se charge de stocker des valeurs du formulaire
//afin de les utiliser dans notre objet new Client($form), grace à notre hydratation
$form = array();
var_dump($_POST);
if (isset($_POST['majeur']) && isset($_POST['reglement'])) {//!! permet de verifier tous les paramétres(exist, non null, non vide...)
    if (!!($_POST['tel'])) {
        $form['tel'] = $_POST['tel'];
    }

    $form['newsLetterInscription'] = isset($_POST['newsLetter']) ? 1 : 0; //ternaire pour mettre  1  si le client est ok pour la newsletter et 0 s'il n'est pas d'accord

    if (!!($_POST['nom']) && !!($_POST['prenom']) && !!($_POST['mail']) && !!($_POST['adresse']) && !!($_POST['ville']) && !!($_POST['cp'])) {
        $form['nom'] = $_POST['nom'];
        $form['prenom'] = $_POST['prenom'];
        $form['mail'] = $_POST['mail'];
        $form['adresse'] = $_POST['adresse'];
        $form['ville'] = $_POST['ville'];
        $form['cp'] = $_POST['cp'];
//        $form['dateinscription']= now();//finalement pour rentrer la date on va utiliser la base de donnée en 
//        mettant dateInscription en CURRENT_TIMESTAMP par defaut
        $form['ip'] = $_SERVER['REMOTE_ADDR'];
        $form['session_id'] = $_COOKIE['PHPSESSID'];

        //nouvel objet  $client de la classe client prenant les valeurs du tableau $form
        $client = new Client($form);
        //on affecte les valeurs  de la fonction addClient avec l'objet $client en argument à l'objet $manager
        $manager->addClient($client);
    } else {
        echo 'erreur de formulaire'; // gestion des erreurs en php
    }
    echo ' formulaire ok';
    var_dump($client);
}//fin fonction  formulaire


function securisation($champAsecuriser) {

    $champAsecuriser = htmlspecialchars($champAsecuriser);
    $champAsecuriser = trim($champAsecuriser);
    $champAsecuriser = stripcslashes($champAsecuriser);
    $champAsecuriser = strip_tags($champAsecuriser);
    $champAsecuriser = htmlentities($champAsecuriser);
    //  var_dump($champAsecuriser);
    return $champAsecuriser;
}

var_dump($db);







//var_dump($_SESSION);
var_dump($_SERVER);
var_dump($_COOKIE);
?>
<!DOCTYPE html>
<!--
formulaire d'inscription 
-->
<html>
    <head>
        <title>Formulaire d'inscription</title>
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
                            <h1>Inscrivez-vous ci-dessous:</h1>
                            <p>Tous les champs marqués d'une <span class="asteriskField">*</span> sont obligatoires</p>

                        </div>
                    </div>


                    <div class="row"><!--nom et prenom-->
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <form method="post" name="inscription" action="indexFd.php">
                                <div class="form-group ">
                                    <label class="control-label requiredField" for="nom">Nom<span class="asteriskField">*</span></label>
                                    <input class="form-control" id="nom" name="nom"   type="text" placeholder="votre nom...."  maxlength="48"/>
                                </div>

                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12 offset-1">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="prenom">Prénom<span class="asteriskField"> * </span></label>
                                <input class="form-control" id="prenom" name="prenom"  type="text" placeholder="votre prénom...." maxlength="48"/>
                            </div> 
                        </div>
                    </div>
                    <!--</div>-->
                    <div class="row"><!--adresse-->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="adresse">Adresse<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-bus"></i>
                                    </div>
                                    <input class="form-control" id="adresse" name="adresse" placeholder="1 avenue du riz" type="text" maxlength="200"/>
                                </div>
                            </div>
                        </div>
                    </div>  

                    <div class="row"><!--Cp  et ville-->
                        <div class="col-md-3 col-sm-3 col-xs-12">    

                            <div class="form-group ">
                                <label class="control-label requiredField" for="cp">Code Postal<span class="asteriskField">*</span></label>
                                <input class="form-control" id="cp" name="cp" type="text" maxlength="5"/>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-3 col-xs-12 offset-1"> 
                            <div class="form-group ">
                                <label class="control-label requiredField" for="ville">Ville<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control" id="ville" name="ville" placeholder="Sainte-Marie" type="text" maxlength="48"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row"><!--email et tel-->

                        <div class="col-md-3 col-sm-3 col-xs-12 offset-1"> 
                            <div class="form-group ">
                                <label class="control-label requiredField" for="tel">Telephone<span class="asteriskField"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control" id="tel" name="tel"  type="tel" maxlength="20"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='mail' for="mail"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="mail" name="mail"  type="email" maxlength="48"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--</div>-->



                    <div class="row"><!--reglement-->
                        <div class="col-md-3 col-sm-3 col-xs-12"> 
                            <input type="checkbox" name="reglement" value="ON" /> j'accepte le règlement du jeu<span class="asteriskField">*</span>
                        </div>
                        <!--</div>-->

                        <div class="col-md-3 col-sm-3 col-xs-12 offset-1"> 
                            <input type="checkbox"  id="newsLetter" name="newsLetter" value="ON" /> Inscription à la clientletter
                        </div>
                    </div>

                    <div id="espace"> </div><!--espace entre bouton et reglement-->

                    <div class="row"><!--majeur et bouton validation-->
                        <div class="col-md-3 col-sm-3 col-xs-12"> 
                            <input type="checkbox" id="majeur" name="majeur" value="ON" onClick=""/> je reconnais être majeur<span class="asteriskField">*</span>
                        </div>
                        <!--                </div>-->
                        <!--
                                       <br/><br/>
                                        <div class="row">bouton validation-->

                        <div class="col-md-3 col-sm-3 col-xs-12">     
                            <div class="form-group">
                                <div>
                                    <button class="btn btn-success " id="inscription"    name="inscription" type="submit">Valider mon Inscription</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready($(function () {
        //  $("#date").mask("99/99/9999");

        $("#tel").mask("(09)99 99 99 99");
        $("#cp").mask("99999");
//        $("#nom").mask({mask: "[a-zA-Z0-9._%-]{2, 20}"});
        $("#nom").regex("");
        $("#nom").mask({mask: "aaaa"});


//                                              $("#mail").mask({
//                                                mask: "{1,20}[.{1,20}][.{1,20}][.{1,20}]@*{1,20}[.{2,6}][.{1,3}]",
//                                                greedy: false,
//                                                regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+.[a-zA-Z]{2,4}",
//                                                isComplete: function(buffer, opts) {return new RegExp(opts.regex).test(buffer.join(" "));}
//                                                });
//                                                
        //$("#email").mask('Regex', {regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{4,30}"});

//fonction de controle de saisie du formulaire

        function testerCheckbox(checkbox) {
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    alert("Système = " + checkbox[i].value)
                }
            }
        }


//fonction verification mail
        function verifiermail(email) {
            if ((email_add.indexOf("@") != 1) && (email_add.indexOf(".") != 2)) {
                return true
            } else {
                alert("Mail invalide !");
                return false
            }
            ;

        }
        ;

        //Si le second paramètre vaut true, cette fonction colore le champ en rouge pâle. Sinon, elle enlève le coloriage.    
        function surligne(champ, erreur)
        {
            if (erreur)
                champ.style.backgroundColor = "#fba";
            else
                champ.style.backgroundColor = "";
        }

//https://openclassrooms.com/courses/tout-sur-le-javascript/td-verification-d-un-formulaire
//vérification de la longueur d'un champ

        function verifPseudo(champ)
        {
            if (champ.value.length < 2 || champ.value.length > 25)
            {
                surligne(champ, true);
                return false;
            } else
            {
                surligne(champ, false);
                return true;
            }
        }

    }));//fin function
    //fin document ready






</script>

</body>
</html>




