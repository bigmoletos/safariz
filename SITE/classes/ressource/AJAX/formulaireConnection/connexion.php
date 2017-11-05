<?php //  cette page permet en AJAX de  verifier dynamiquement la saisie du login pour s'assurer qu'il n'existe
// pas deja dans la base' de donnée  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>version avec Ajax</title>
    </head>
    <body>
        <!--<p>cette page affiche les mots de la base qui correspondent au mot saisie en page rechercheBDR.php dans le span du formulaire</p>-->


        <?php
        $bd = new PDO("mysql:host=localhost;dbname=safariz", "root", "");
        $req = $bd->query("select login from administrateur");
        $tab = $req->fetchAll();
        $q = $_REQUEST["q"];
        $indice = "";
        if ($q !== "") {
            $q = strtolower($q);
            $len = strlen($q);
            foreach ($tab as $valeur) {
                if (stristr($q, substr($valeur[0], 0, $len))) {
                    if ($indice === "") {
                        $indice = $valeur[0];
                    } else {
                        $indice .= ", $valeur[0]";
                    }
                }
            }
        }
        echo $indice === "" ? "Pas de suggestion" : $indice;
        ?>
    </body>
</html>
