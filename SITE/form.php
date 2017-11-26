<?
include("header.php"); ?>

    <main id="content" class="col-12 col-md-9">

        <!-- integration formulaire de Franck -->
        <div class="bootstrap-iso">
            <!-- <div class="container-fluid"> -->

            <div class="well">
                <div class="row">
                    <!--titre-->
                    <div class="col-8">
                        <h1>Inscrivez-vous ci-dessous :</h1>
                        <p>Tous les champs marqués d'une <span class="asteriskField">*</span> sont obligatoires</p>

                    </div>
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
                                echo (isset($messageConfirmationMotPasse)) ? $messageConfirmationMotPasse : "";
//                                 echo (isset($_COOKIE['messageLoginClient'])) ? $_COOKIE['messageLoginClient'] : "";
//                                 echo (isset($_COOKIE['messageLoginClientKo'])) ? $_COOKIE['messageLoginClientKo'] : "";
//                                 echo (isset($_SESSION['messageLoginClient'])) ? $_SESSION['messageLoginClient'] : "";
//                                 echo (isset($_SESSION['messageLoginClientKo'])) ? $_SESSION['messageLoginClientKo'] : "";
                                 
                                 
                                ?>
                            </p>
                        </div><!--fin messages retour-->

                    </div>
                </div>
                <form method="post" name="inscription" id='inscription'  onsubmit="return verifForm(this)">
                    <!--<form method="post" name="inscription" id='inscription' action="jeusafariz.php">-->
                    <div class="row">
                        <!--nom et prenom-->
                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <div class="form-group ">
                                <label class="control-label requiredField" for="nom">Nom<span class="asteriskField">*</span></label>
                                <input class="form-control" id="nom" name="nom" type="text" placeholder="votre nom...." minlength="2" maxlength="48" onblur="verifNom(this)" required/>
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="prenom">Prénom<span class="asteriskField"> * </span></label>
                                <input class="form-control" id="prenom" name="prenom" type="text" placeholder="votre prénom...." minlength="2" maxlength="48" onblur="verifPrenom(this)" required/>
                            </div>
                        </div>
                    </div>
                    <!--</div>-->
                    <div class="row">
                        <!--adresse-->
                        <div class="col-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="adresse">Adresse<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-bus"></i>
                                    </div>
                                    <input class="form-control" id="adresse" name="adresse" placeholder="1 avenue du riz" type="text" minlength="5" maxlength="200" onblur="verifAdresse(this)" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!--Cp  et ville-->
                        <div class="col-md-4 col-sm-4 col-xs-12">

                            <div class="form-group ">
                                <label class="control-label requiredField" for="cp">Code Postal<span class="asteriskField">*</span></label>
                                <input class="form-control" id="cp" name="cp" type="text" maxlength="5" placeholder="13008" onblur="verifCp(this)"/>
                            </div>
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="ville">Ville<span class="asteriskField">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control" id="ville" name="ville" placeholder="Sainte-Marie" type="text" minlength="2" maxlength="48" onblur="verifVille(this)" required/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!--email et tel-->

                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" for="tel">Telephone</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i>
                                    </div>
                                    <input class="form-control" id="tel" name="tel" type="tel" minlength="10" placeholder="(0_)__ __ __ __"  maxlength="20" onblur="verifTel(this)"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='mail' for="mail"> Email <span class="asteriskField"> * </span></label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                    </div>
                                    <input class="form-control" id="mail" name="mail" type="email"  placeholder="xxx@xxx.xx"  minlength="6" maxlength="48" onblur="verifMail(this)" required/>
                                </div>
                            </div>
                        </div>
                        <!--**********************-->
                        <div class="col-12 text-center mt-5">
                            <div class="form-group">
                                <div>
                                    <p>Si vous souhaitez rejouer sans remplir à nouveau le formulaire veuillez nous indiquer un mot de passe <br>( pour vous reconnecter nous vous inviterons à saisir votre mail et votre mot de passe)  </p>
                                    <!--<button class="btn btn-primary " name="inscriptionClient" type="submit">voulez-vous vous inscrire?</button>-->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='passwordA' for="password" > Mot de passe </label>
                                    <!--<span class="asteriskField"> * </span></label>-->

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                        </div>
                                        <input class="form-control" id="password" name="password" type="password" placeholder="votre mot de passe..." minlength="5" maxlength="48" onblur="return verifPassword(this)"/>
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group ">
                                <label class="control-label requiredField" id='confirmpwdA' for="confirmpwd" > Confirmation mot de passe </label> 
                                    <!--<span class="asteriskField"> * </span></label>-->

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i>
                                        </div>
                                        <input class="form-control" id="confirmpwd" name="confirmpwd" type="password" placeholder="votre mot de passe..."  minlength="5" maxlength="48" onblur="return verifConfirmPassword2(this)"/>
                                    </div>
                            </div>
                        </div>
                    </div>  
                    <!--************************-->                  
                    <!--                </div>-->
                    <!--</div>-->



                    <div class="row">
                        <!--majeur et bouton validation-->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="checkbox" id="majeur" name="majeur" value="ON" onsubmit="return verifMajeur(this)" required/> je reconnais être majeur<span class="asteriskField">*</span>
                        </div>
                        <!--</div>-->

                        <!--reglement-->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="checkbox" name="reglement" value="ON" onsubmit="return verifReglement(this)" required/> j'accepte le règlement du jeu<span class="asteriskField">*</span>
                        </div>
                        <!--</div>-->

                        <!--newsletter-->
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="checkbox" name="newsletter" value="ON" checked/> Inscription à la newsletter
                        </div>
                        <!--</div>-->


                    </div>

                    <div id="espace"> </div>
                    <!--espace entre bouton et reglement-->

                    <div class="row">

                        <!--</div>-->
                        <!--<br/><br/><div class="row">bouton validation-->

                        <div class="col-12 text-center mt-5">
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
        <!--</div> container.fluid-->

        <!-- fin formulaire de Franck -->

    </main>
    <!-- content -->
</section>

<?php include("footer.php"); ?>



<script type="text/javascript">


    //function qui change le fond en rouge si erreur de saisie d'un champ
    function surligne(champ, erreur)
    {
        if (erreur)
            champ.style.backgroundColor = "#fba";
        else
            champ.style.backgroundColor = "";
    }

    //function de verification du champ mail
    function verifMail(champ)
    {
        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        if (!regex.test(champ.value))
        {
            // var messageMail= "Veuillez remplir correctement  le champ mail ";
            //    alert("Veuillez remplir correctement  le champ mail ");
            //  document.write(messageMail);

            return false;
        } else
        {
            surligne(champ, false);
            ;
            return true;
        }
    }

//function de verification du champ tel
    function verifTel(champ)
    {
        var regex = /[0-9._-]{10, 15}/;
        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }
//function de verification du champ ville
    function verifVille(champ)
    {
//        if (champ.value.length < 2 || champ.value.length > 25)
        var regex = /[a-zA-Z._-]{2, 25}/;
        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }
//function de verification du champ adresse
    function verifAdresse(champ)
    {
        if (champ.value.length < 5 || champ.value.length > 40)
//        var regex = /^[a-zA-Z0-9._-]{5, 40}$/;
//        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }
//function de verification du champ CP
    function verifCp(champ)
    {
        var regex = /^[0-9]{4, 5}$/;
        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }
//function de verification du champ nom
    function verifNom(champ)
    {
        if (champ.value.length < 2 || champ.value.length > 25)
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
        {
            surligne(champ, true);
//            str.charAt(0).toUpperCase();
//           champ=champ.charAt(0).toUpperCase() + champ.substring(1).toLowerCase();

            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }
//function de verification du champ prenom
    function verifPrenom(champ)
    {
        if (champ.value.length < 2 || champ.value.length > 25)
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }

//function de verification de la checkbox reglement
    function verifReglement(champ)
    {
        if (champ.value = "")
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }

////function de verification de la checkbox majeur
    function verifMajeur(champ)
    {
        if (champ.value = "")
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }

//function de verification du champ  password
    function verifPassword(champ)
    {
        if (champ.value.length < 5 || champ.value.length > 25)
//        var regex = /^[a-zA-Z._ -]{2, 25}$/;
//        if (!regex.test(champ.value))
        {
            surligne(champ, true);
            return false;
        } else
        {
            surligne(champ, false);
            return true;
        }
    }
//function de verification du champ confirmation password
//    function verifConfirmPassword(champ)
//    {
//        if (champ.value.length < 5 || champ.value.length > 25) 
////        var regex = /^[a-zA-Z._ -]{2, 25}$/;
////        if (!regex.test(champ.value))
//
//        {
////           password.setCustomValidity("vos mots de passe sont différents veuillez les ressaisir");
////           document.getElementById("confirmpwd").innerHTML = "vos mots de passe sont différents veuillez les ressaisir";
//            surligne(champ, true);
//            return false;
//        } else
//        {
//            surligne(champ, false);
//            return true;
//        }
//    }

/////////////////////////////////
//verif format confirmation mot de passe

//function verifConfirmPassword3(champ) {
//    
//    var confirm = document.getElementById("confirmpwd");
//    var password=document.getElementById("password");
////  document.getElementById('confirmpwd').innerHTML = confirm;
//    
//        if(champ.value == document.getElementByClassName('password')[0]){
////        document.getElementById("confirmpwd").innerHTML = confirm.validationMessage;
//        
//            document.getElementById("confirmpwd").innerHTML = "vos mots de passe sont ok";
//            surligne(champ, true);
//            return true;
//    } else {
//        document.getElementById("confirmpwd").innerHTML = "vos mots de passe sont différents veuillez les ressaisir";
//        surligne(champ, false);
//            return false;
//    } 
//} 
//////////////////////////////
//::::::::::::::::::::::::::::
function verifConfirmPassword2(champ)
{  
   if(champ.value != document.getElementById('password').value)
   {
      document.getElementById("confirmpwdA").innerHTML = "vos mots de passe sont différents veuillez les ressaisir";
//      confirmpwd.setCustomValidity("vos mots de passe sont différents veuillez les ressaisir");
//            alert("MDP different");
      surligne(champ, true);
      return false;
   }
   else
   {
      document.getElementById("confirmpwdA").innerHTML = "vos mots de passe sont identiques ";
//            alert("MDP similaire");
      surligne(champ, false);
      return true;
   }
}
//:::::::::::::::::::::::::::::::::
    

    //verif complete des champs du formulaire
    function verifForm(f)
    {
        var cpOk = verifCp(f.cp);
        var villeOk = verifVille(f.ville);
        var adresseOk = verifAdresse(f.adresse);
        var nomOk = verifNom(f.nom);
        var prenomOk = verifPrenom(f.prenom);
        var mailOk = verifMail(f.email);
        var telOk = verifTel(f.tel);
        var reglementOk = verifReglement(f.reglement);
        var majeurOk = verifMajeur(f.majeur);
        var verifConfirmPasswordOk= verifConfirmPassword2(f.confirmpwd)
        var verifPasswordOk= verifPassword(f.password)

        if (cpOk && mailOk && adresseOk && telOk && nomOk && prenomOk && villeOk && reglementOk && majeurOk && verifPasswordOk && verifConfirmPassword2Ok )
            return true;
        else
        {
            alert("Veuillez remplir correctement tous les champs");
            return false;
        }
    }
    //message personnalise champ mail
    var email = document.getElementById("mail");
    email.addEventListener("keyup", function (event) {
        if (email.validity.typeMismatch) {
            email.setCustomValidity("Merci de saisir une adresse e-mail valide");
        }
    });

//
//function nomPropre(mot) {
//  var m=mot.charAt(0).toUpperCase() + mot.substring(1).toLowerCase();
//  console.log(m);
//  return m;
//et rajouter :	onClick="nomPropre(this.form.mot.value)"
//}


//    ***********************************************************
//    **********************************************************        
    $(document).ready($(function () {
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
//        $("#email").mask('Regex', {regex: "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\.[a-zA-Z]{2,4}"});

        //fonction de controle de saisie du formulaire

//        function testerCheckbox(checkbox) {
//            for (var i = 0; i < checkbox.length; i++) {
//                if (checkbox[i].checked) {
//                    alert("Système = " + checkbox[i].value)
//                }
//            }
//        }

//        //fonction verification mail
//        ***********************************
//         //message personnilsé sur les mails
//         
//        var email = document.getElementById("mail");
//        email.addEventListener("keyup", function (event) {
//            if (email.validity.typeMismatch) {
//                email.setCustomValidity("Nous voudrions une adresse e-mail.");
//            }
//        });
//        
//        **********************************
//        //function qui change le fond en rouge si erreur de saisie d'un champ
//        function surligne(champ, erreur)
//        {
//            if (erreur)
//                champ.style.backgroundColor = "#fba";
//            else
//                champ.style.backgroundColor = "";
//        }

    }));//fin function
    //fin document ready
</script>
</body>
</html>