<?php 

echo'ok';


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
                        <form method="post" name="inscription" action="formulaire2.php">
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
                                <label class="control-label requiredField" id='email' for="email"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="email" name="email"  type="email" maxlength="48"/>
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
                                    <input type="checkbox" name="newsletter" value="ON" /> Inscription à la newsletter
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
                               <button class="btn btn-primary " name="bouton" type="submit">Valider mon Inscription</button>
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
                   $(document).ready( $(function () {
                        //  $("#date").mask("99/99/9999");
                        $("#tel").mask("(09)99 99 99 99");
                        $("#cp").mask("99999");

//                                                $("#email").mask({
//                                                mask: "{1,20}[.{1,20}][.{1,20}][.{1,20}]@*{1,20}[.{2,6}][.{1,3}]",
//                                                greedy: false,
//                                                regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+.[a-zA-Z]{2,4}",
//                                                isComplete: function(buffer, opts) {return new RegExp(opts.regex).test(buffer.join(" "));}
//                                                });
//                                                
                        $("#email").mask('Regex', { regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}" });
                  
    //fonction de controle de saisie du formulaire
    
   function testerCheckbox(checkbox) {
      for (var i=0; i<checkbox.length;i++) {
         if (checkbox[i].checked) {
            alert("Système = "+checkbox[i].value)
         }
      }
   }

    
    //fonction verification mail
    function verifiermail(email) {
      if ((email_add.indexOf("@")!=1) && (email_add.indexOf(".")!=2)) {
         return true 
      } else {
         alert("Mail invalide !");
         return false
      };
      
   };
    
    
    }));//fin function
                   //fin document ready
                
                
                
                
                
                
                </script>

    </body>
</html>


