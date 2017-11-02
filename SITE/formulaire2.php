<?php ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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

    <body class="container">
        <div class="bootstrap-iso">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <form method="post" name="inscription" action="index.php">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="nom">NOM<span class="asteriskField">*</span></label>
                                <input class="form-control" id="nom" name="nom"   type="text" placeholder="votre nom...."  maxlength="48"/>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="prenom">PRENOM <span class="asteriskField"> * </span></label>
                                <input class="form-control" id="prenom" name="prenom"  type="text" placeholder="votre prénom...." maxlength="48"/>
                            </div>
            </div>
        </div>
 <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='email' for="email"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="email" name="email"  type="email" maxlength="48"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="tel">Telephone<span class="asteriskField"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control" id="tel" name="tel"  type="tel" maxlength="20"/>
                                </div>
                            </div>
            </div>
</div>
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="adresse">adresse<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-bus"></i>
                                    </div>
                                    <input class="form-control" id="adresse" name="adresse" placeholder="1 avenue du riz" type="text" maxlength="200"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="cp">Code Postal<span class="asteriskField">*</span></label>
                                <input class="form-control" id="cp" name="cp" type="text" maxlength="5"/>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="ville">Ville<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control" id="ville" name="ville" placeholder="Sainte-Marie" type="text" maxlength="48"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <button class="btn btn-primary " name="ok" type="submit">OK</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
                                        <script type="text/javascript">
                                           $(document).ready( $(function () {
                                                //  $("#date").mask("99/99/9999");
                                                $("#tel").mask("(09)99 99 99 99");
                                                $("#cp").mask("99999");
                                                
                                                $("#email").inputmask({
                                                mask: "{1,20}[.{1,20}][.{1,20}][.{1,20}]@*{1,20}[.{2,6}][.{1,3}]",
                                                greedy: false,
                                                regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+.[a-zA-Z]{2,4}",
                                                isComplete: function(buffer, opts) {return new RegExp(opts.regex).test(buffer.join(''));}
                                                });
//                                                $("#email").inputmask('Regex', { regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}" });
                                            }));//fin function
                                           //fin document ready
                                        </script>

    </body>
</html>



