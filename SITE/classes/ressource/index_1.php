<?php
require 'autoload.php';
require 'connection.php';
$db = connect();
$manager = new NewsManager($db);
date_default_timezone_set("Europe/Paris");


$nb = 3;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 0;
$count = $manager->count();

function paginate($page, $nb, $count) {
    $nbpages = (int) $count / $nb;
    $reste = $count % $nb;
    $nbpages = ($reste == 0) ? $nbpages : $nbpages + 1;
    $paginate = "<p>Pagination</p>";
    for ($i = 1; $i < $nbpages; $i++) {
        $paginate .= '<a href="?page=' . ($i - 1) . '">' . $i . '</a> ';
    }
    return $paginate;
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Site de News</title>
        <style type="text/css">
            div{
                width:90%;
                padding:2% 5% ;
            }
            p{
                text-align: justify;
            }
            .pagination a{margin:0 25px;}
            .pagination, .pagination p{text-align: center;}
            .listimg{
                width:200px;
                float:left;
                margin-right:50px;
            }
            .img{
                display: block; margin: 0 auto;
            }
            .title{text-align: center;}
        </style>
    </head>
    <body>
        <h1>Mon super site de news</h1>
        <p><a href="admin.php">Accéder à l'espace d'administration</a></p>
        <?php
        if (isset($_GET['id'])) {
            $news = $manager->load((int) $_GET['id']);
            ?>
            <p><a href=".">Retour à l'accueil</a></p>
            <?php
            echo '<div><p>Par <em>', $news->auteur(), '</em>, le ', $news->dateAjout()->format('d/m/Y à H\hi'), '</p>', "\n",
            '<h1 class="title">', $news->titre(), '</h2>', "\n",
            '<img src="', $news->image(), '" class="img"/>', "\n",
            '<p>', nl2br($news->contenu()), '</p>', "\n";

            if ($news->dateAjout() != $news->dateModif()) {
                echo '<p style="text-align: right;"><small><em>Modifiée le ', $news->dateModif()->format('d/m/Y à H\hi'), '</em></small></p>';
            }
            echo "</div>";
        } else {
            echo "<h2 style='text-align:center'>Liste des dernières news - Page ". ($page+1) ."</h2>";

            foreach ($manager->getList($page * $nb, $nb) as $news) {
                if (strlen($news->contenu()) <= 200) {
                    $contenu = $news->contenu();
                } else {
                    $debut = substr($news->contenu(), 0, 400);
                    $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';

                    $contenu = $debut;
                }

                echo '<div><img src="', $news->image(), '"/ class="listimg"><h3><a href="?id=', $news->id(), '">', $news->titre(), '</a></h3>', "\n",
                '<p>', nl2br($contenu), '</p></div>';
            }
            echo "<div class='pagination'>" . paginate($page, $nb, $count) . "</div>";
        }
        ?>
    </body>
</html>
