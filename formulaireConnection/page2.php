
<html>
    <head>
        <meta charset="UTF-8">
        <title>version avec Ajax</title>
    </head>
    <body>
        <p>cette page affiche les mots de la base qui correspondent au mot saisie page1 dans le span du formulaire</p>


        <?php
        $bd = new PDO("mysql:host=localhost;dbname=keywords", "root", "root");
        $req = $bd->query("select value from Keywords");
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
