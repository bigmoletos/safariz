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
//require ('classes/ClientManager.php');
//require ('classes/Client.php');

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
if (isset($_POST['veriflog'])) {
    //creation du cookie login autologin? date d'expiration dans 1an
    $securisationLog = securisation($_POST['password']);
    $cookielog = ' ' . $securisationLog . ' '; //on créer une variable qui possède le contenu du champ password
    setcookie('cookielog', ' ' . $cookielog . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    $securisationClient = securisation($_POST['mailClient']);
    $cookiemailClient = ' ' . $securisationClient . ' '; //on créer une variable qui possède le contenu du champ password
    setcookie('cookiemailClient', ' ' . $cookiemailClient . ' ', time() + 365 * 24 * 3600, null, null, false, true); //on créer un cookie 'autopsd' avec la variable cookiepsd
    var_dump($cookiemailClient);
    var_dump($cookielog);

    if (!!($_POST['password']) && !!($_POST['mailClient'])) {
        $form['password'] = securisation($_POST['password']);

        $form['mail'] = securisation($_POST['mailClient']);
        $LogClient = new Client($form);
        $verificationLog = $manager->clientLogin($LogClient);
        var_dump($verificationLog);
        $hash = $verificationLog['password'];
        $nom = $verificationLog['nom'];
        $prenom = $verificationLog['prenom'];
       // var_dump($hash);
        if (password_verify($form['password'], $hash)) {

            //   echo "mot de passe ok Bonjour $prenom $nom  nous vous souhaitons bonne chance!</br>";
            $messageLoginClient = "Bonjour $prenom $nom nous vous souhaitons bonne chance aujourd'hui!</br>  ";
            $cookiemessageLoginClient = $messageLoginClient;
            setcookie('messageLoginClient', ' ' . $cookiemessageLoginClient . ' ', time() + 5 * 60, null, null, false, true);
           // var_dump($cookiemessageLoginClient);

            header("location: jeusafariz.php");
        } else {
            $cookiemessageLoginClientKo = "mot de passe incorrect veuillez le ressaisir";
           // var_dump($cookiemessageLoginClientKo);
            setcookie('messageLoginClientKo', ' ' . $cookiemessageLoginClientKo . ' ', time() + 5 * 60, null, null, false, true);
          //  var_dump($cookiemessageLoginClientKo);
          //  echo 'mot de passe incorrect veuillez le ressaisir';
        }
        //   var_dump($form);
        //  var_dump($_POST);
        // var_dump($verificationLog);
        // var_dump($LogClient);
        // var_dump($manager);
        //          header ("location: loginClientSuite.php");
    }
}////fin fonction fomulaire test !! password
//var_dump($form);
//var_dump($_POST);
//var_dump($db);
//var_dump($_SESSION);
//var_dump($_SERVER);
//var_dump($_COOKIE);
?>
<?php include("header.php"); ?>

<main id="content" class="col-12 col-md-9">  
    <div class="bootstrap-iso">
        <!-- <div class="container-fluid"> -->
        <div class="well">
            <div class="row">
                <div class="col-12">
                    <div class="col-8">
                        <h1>Accès participant</h1>
                        <p>Tous les champs marqués d'une <span class="asteriskField"> *</span> sont obligatoires</p>

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
                                    echo (isset($_COOKIE['messageLoginClient'])) ? $_COOKIE['messageLoginClient'] : "";
                                    echo (isset($_COOKIE['messageLoginClientKo'])) ? $_COOKIE['messageLoginClientKo'] : "";
                                    ?>
                                </p>
                            </div><!--fin messages retour-->
                        </div> 
                        <form method="post" action="clientLogin.php">                               

                            <div class="col-12 col-md-6">
                                <label class="control-label requiredField" id='mail' for="mail">Email<span class="asteriskField">*</span></label>
                                <div class="input-group"><div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input class="form-control" id="mailClient" name="mailClient" type="email"  minlength="3" maxlength="48"  placeholder="xxxx@xxxx.xx" required/></div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="control-label requiredField" for="password">Mot de passe<span class="asteriskField"> *</span></label>
                                <div class="input-group"><div class="input-group-addon"><i class="fa fa-user-o" aria-hidden="true"></i></div>
                                    <input class="form-control" id="password" name="password" placeholder="votre mot de passe..." type="password" minlength="3" maxlength="48" required/></div>
                            </div>
                    </div>
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
    //        controle de saisie dynamique du champ password afin de verifier qu'il n'existe pas
    //         deja dans la base, réalisé en AJAX
    $(document).ready(
            function () {
                $("#txt").keyup(function () {
                    $("#password").load("classes/ClientManager.php", {q: $("#txt").val()});
                });
            }); //fin document ready
</script>
<!--    </body>
</html>-->