<?php

require('chargeurClass.php');
require('connexionBD.php');
require('classes/AdminJeu.php');
//require('admin.php');

$db = connexionDB();
//nouvel objet de la classe adminManagerjeu instancié 
//par les attributs de la connexionDB() à la base donnée mysql
$manager = new AdminManagerJeu($db);
$dates = $manager->ouvertureJeu();

date_default_timezone_set("Europe/Paris");

$now = date("Y-m-d");

$date_debut_jeu=$dates['date_debut_jeu']  ;
$date_fin_jeu=$dates['date_fin_jeu'];

if ($now >= $date_debut_jeu && $now <= $date_fin_jeu) {
    $message = 'Cliquez pour participer à notre jeu Safa\'Riz<br/><br/><a href="jeusafariz.php"><button class="jouer" name="bouton" type="submit" style="color:white;">JOUER</button>';
}
elseif ($now <= $date_debut_jeu){
    $message = "Désolé le jeu n'est pas ouvert actuellement.<br/>Reconnectez-vous à partir du ".$date_debut_jeu;
}
 else {
    $message = "Désolé ce jeu est terminé.";    
}
?>

<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Safa'riz Le Jeu</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style/styleFormulaire.css" type="text/css" charset="utf_8"/>
	<link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
	<link href="style/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="style/style.css">
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	<script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/dist/jquery.maskedinput.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" href="style/bootstrap-iso.css"/>
	<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body class="container">
	<section id="header" class="row">
		<div id="logo_safariz" class="col-sm-12 col-md-3">
                    <a href="index.php"><img src="image/safariz.png" alt="logo safariz" height="190" width="250" responsive-image></a>
		</div>

		<main id="content" class="col-sm-12 col-md-9">

			<div class="bootstrap-iso"><!-- <div class="container-fluid"> -->

				<div class="well">
					<div id="messageIndex" class="row">
						<!--titre-->
						<div class="col-12">
							<h1><?php echo $message; ?></h1>
						</div>
					</div>

				</div><!--</div> container.fluid-->
                            </div>
			
		</main><!-- content -->
        </section>
                
<?php include("footer.php"); ?>
</body>
</html>