<?php
/* require('chargeurClass.php');
require('connexionBD.php');
require('classes/AdminJeu.php');

$db = connexionDB();
//nouvel objet de la classe adminManagerjeu instancié 
//par les attributs de la connexionDB() à la base donnée mysql
$manager = new AdminManagerJeu($db);
$dates = $manager->ouvertureJeu();
var_dump($dates);

date_default_timezone_set("Europe/Paris");
$now = date("Y-m-d H:i:s"); */

session_start();

$message = "Bravo vous avez gagné \"un Safa'Riz en Camarague !\" <br/>Vous serez contactez en fin de jeu pour les modalités de retrait de votre gain.<br><br>En attendant, visitez notre site";    

?>
<?php include("header.php"); ?>

		<main id="content" class="col-sm-12 col-md-9">


			<!-- integration formulaire de Franck -->
			<div class="bootstrap-iso">
				<!-- <div class="container-fluid"> -->

				<div class="well">
					<div id="messageIndex" class="row">
						<!--titre-->
						<div class="col-12">
							<h3><?php echo $message; ?></h3>
                                                        <h3><a href="http://www.rizdecamargue.com/" target="_blank">www.rizdecamargue.com</a></h3>
						</div>
					</div>

				</div>
				<!--</div> container.fluid-->
			</div>
			</div>
			</div>
			


		</main>
		<!-- content -->
                </section>			

</body>
<?php include("footer.php"); ?>
</html>