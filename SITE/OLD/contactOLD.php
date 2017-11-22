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


			<!-- integration formulaire de Franck -->
			<div class="bootstrap-iso">
				<!-- <div class="container-fluid"> -->

				<div class="well">
					<div class="row" ><!--titre-->

                        <h1>Formulaire de contact</h1>
                        <p>Tous les champs marqués d'une <span class="asteriskField">*</span> sont obligatoires</p>


                    </div>


                    <!--nom et prenom-->

                    <form method="post" name="inscription" action="formulaire2.php">
                        <div class="form-group ">
                            <label class="control-label requiredField" for="nom">Nom<span class="asteriskField">*</span></label>
                            <input class="form-control" id="nom" name="nom"   type="text" placeholder="votre nom...."  maxlength="48"/>
                        </div>


                        <div class="form-group ">
                            <label class="control-label requiredField" for="prenom">Prénom<span class="asteriskField"> * </span></label>
                            <input class="form-control" id="prenom" name="prenom"  type="text" placeholder="votre prénom...." maxlength="48"/>
                        </div> 




                        <!--message-->


                        <div class="form-group ">
                            <label class="control-label requiredField" for="cp">Votre message<span class="asteriskField">*</span></label>
                            
                            <textarea placeholder="Votre message ici" class="form-control" id="msg" name="msg"   maxlength="5" rows="4" cols="50">
 </textarea>






                            <div class="form-group ">
                                <label class="control-label requiredField" id='mail' for="mail"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="mail" name="mail"  type="email" maxlength="48">
                                </div>


                            </div>
                            <!--</div>-->

                            <div class="row"><!--reglement-->


                                <div class="col-md-3 col-sm-3 col-xs-12 offset-1"> 
                                    <input type="checkbox" name="newsletter" value="ON" /> Inscription à la newsletter
                                </div>


                                <div id="espace"> </div><!--espace entre bouton et reglement-->



                                <div class="form-group">
                                    <div>
                                        <button class="btn btn-primary " name="bouton" type="submit">Envoyer le message</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="margin-left:15px">
                                        Vous pouvez aussi envoyer un mail à <a href="mailto:service.consommateur@safariz.fr"> Service consommateurs Safariz</a>
                                    </div>
                                </div>

                            </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
</div>

</main>
		<!-- content -->
	</section>

<?php include("footer.php"); ?>

<script type="text/javascript">
    $(document).ready($(function () {
        //  $("#date").mask("99/99/9999");
        $("#tel").mask("(09)99 99 99 99");
        $("#cp").mask("99999");
//                                                $("#mail").mask({
//                                                mask: "{1,20}[.{1,20}][.{1,20}][.{1,20}]@*{1,20}[.{2,6}][.{1,3}]",
//                                                greedy: false,
//                                                regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+.[a-zA-Z]{2,4}",
//                                                isComplete: function(buffer, opts) {return new RegExp(opts.regex).test(buffer.join(" "));}
//                                                });
//                                                
        $("#mail").mask('Regex', {regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}"});

        //fonction de controle de saisie du formulaire

        function testerCheckbox(checkbox) {
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    alert("Système = " + checkbox[i].value)
                }
            }
        }

        //fonction verification mail
        function verifiermail(mail) {
            if ((mail_add.indexOf("@") != 1) && (mail_add.indexOf(".") != 2)) {
                return true
            } else {
                alert("Mail invalide !");
                return false
            }
            ;

        }
        ;


    }));//fin function
    //fin document ready

</script>

</body>
</html>