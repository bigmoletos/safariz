<!DOCTYPE html>
<html>
    <head>
        <title>Ceci est mon 1er formulaire en PHP</title>

        <meta charset="utf-8"/>
    </head>	


    <body>
        <form name="mon formulaire" method="REQUEST" action="formulairePHP.php">



            <?php
            /* 	function verifMail(champ){
              $regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
              if(!$regex.test(champ.value))
              {
              surligne(champ, true);
              return false;
              }
              else
              {
              surligne(champ, false);
              return true;
              }
              }


              function verifPseudo(champ){

              if(champ.value.length < 2 AND champ.value.length > 25)
              {
              surligne(champ, true);
              return false;
              }
              else
              {
              surligne(champ, false);
              return true;
              }
              }


              function verifForm(f)
              {
              var pseudoOk = verifPseudo(f.pseudo);
              var mailOk = verifMail(f.email);
              var ageOk = verifAge(f.age);

              if(pseudoOk && mailOk && ageOk)
              return true;

              else
              {
              alert("Veuillez remplir correctement tous les champs");
              return false;
              }
              }


              function verifAge(champ)
              {
              var age = parseInt(champ.value);
              if(isNaN(age) || age < 5 || age > 111)
              {
              surligne(champ, true);
              return false;
              }
              else
              {
              surligne(champ, false);
              return true;
              }
              }
             */
            ?>		

            <p>
                <label for = "prenom">entrez votre prénom : </label>
                <input type="text" name="prenom" size="20" maxlength="15" id="prenom" onblur="securisation(this)"/>

                <label for = "nom">entrez votre nom : </label>
                <input type="text" name="nom" size="20" maxlength="15"id="nom" onblur="securisation(this)"/>
                <label for = "pseudo">entrez votre pseudo : </label>
                <input type="text" name="pseudo" size="20" maxlength="15"id="pseudo" onblur="securisation(this)"/>

            </p>

            <p>
                <input type="submit" value="envoyer">
            </p>
        </form>


        <!--<form action="page.php" onsubmit="return verifForm(this)">
          <p>
                Pseudo : <input type="text" name="pseudo" onblur="verifPseudo(this)" /><br />
                E-mail : <input type="text" name="email" size="30" onblur="verifMail(this)" /><br />
                Âge : <input type="text" name="age" size="2" onblur="verifAge(this)" /> ans<br />
                <input type="submit" value="Valider" />
          </p>  
        --> 


<?php

function securisation($donnees) {

    $donnees = htmlspecialchars($donnees);
    $donnees = trim($donnees);
    $donnees = stripcslashes($donnees);
    $donnees = strip_tags($donnees);
    $donnees = htmlentities($donnees);
    return $donnees;
    //if($donnees)
}

echo'<pre>';
print_r($_REQUEST);
echo'</pre>';

if ($_REQUEST["prenom"] == "" || $_REQUEST["nom"] == "" || $_REQUEST["pseudo"] == "") {
    echo "Vous devez compléter tous les champs du formulaire";
}

$prenom = securisation($_REQUEST['prenom']);
$nom = securisation($_REQUEST['nom']);
$pseudo = securisation($_REQUEST['pseudo']);

echo 'ton prenom est: ' . $prenom . '</br>';
echo 'ton nom est: ' . $nom . '</br>';
echo 'ton pseudo est: ' . $pseudo . '</br>';

//cryptage des données en php
// Sources www.stackoverflow.com

function encrypt($pure_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;
}

function decrypt($encrypted_string, $encryption_key) {
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;
}

//on utilise ce cryptage de la maniére suivante:
$messageAChiffrer = "Coucou je suis Guillaume";
$cleSecrete = "MaCleEstIncassable";

// On chiffre le message
$messageChiffre = encrypt($messageAChiffrer, $cleSecrete);

// Pour le lire
$messageDechiffrer = decrypt($messageChiffre, $cleSecrete);



// cryptage du mot de pwd par un hachage en md5 moins efficace que le cryptage mais plus simple
        $form['password'] = md5($form['password']);

        
  //  cryptage du mot de password  par un hachage en password_hash beaucoup efficace que md5
        password_hash("password", PASSWORD_DEFAULT);
?>

    </form>

</body>	
</html>	
