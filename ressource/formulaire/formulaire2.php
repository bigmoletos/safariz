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
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="style/styleFormulaire.css"  type="text/css" charset="utf_8"/>
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.min.css">
        <!--<script src="style/jqueryFiles/jquery-3.2.1.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        <script type="text/javascript" src="style/JQueryFiles/jquery.maskedinput-master/scr/jquery.maskedinput.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
        <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />


    </head>

    <body class="container">
        <div class="bootstrap-iso">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <form method="post" name="inscription">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="nom">NOM<span class="asteriskField">*</span></label>
                                <input class="form-control" id="nom" name="nom"   type="text"/>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="prenom">PRENOM <span class="asteriskField"> * </span></label>
                                <input class="form-control" id="prenom" name="prenom"  type="text"/>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField"  for="email"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="email" name="email"  type="text"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="tel">Telephone<span class="asteriskField"> *</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa "></i>
                                    </div>
                                    <input class="form-control" id="tel" name="tel"  type="text"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="adresse">adresse<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-bus"></i>
                                    </div>
                                    <input class="form-control" id="adresse" name="adresse" placeholder="1 avenue du riz" type="text"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="cp">Code Postal<span class="asteriskField">*</span></label>
                                <input class="form-control" id="cp" name="cp" type="text"/>
                            </div>

                            <div class="form-group ">
                                <label class="control-label requiredField" for="ville">Ville<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-university"></i>
                                    </div>
                                    <input class="form-control" id="ville" name="ville" placeholder="Sainte-Marie" type="text"/>
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

            $(function () {
                //  $("#date").mask("99/99/9999");
                $("#tel").mask("(09)99 99 99 99");
                $("#cp").mask("99999");
                        $("#email").mask('Regex', { regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}");
                //$("#hm").mask("99:99",{placeholder:"-"});
            });

        </script>

    </body>
</html>



