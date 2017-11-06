<?php
// first line of PHP
date_default_timezone_set('Europe/Paris');
//$defaultTimeZone = 'Europe/Paris';
//if (date_default_timezone_get()!= $defaultTimeZone) 
//    date_default_timezone_set($defaultTimeZone);
//en francais
echo '<br />';
//Voici les deux tableaux des jours et des mois traduits en français
$nom_jour_fr = array("dimanche", "lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi");
$mois_fr = Array("", "janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août",
    "septembre", "octobre", "novembre", "décembre");
// on extrait la date du jour
list($nom_jour, $jour, $mois, $annee) = explode('/', date("w/d/n/Y"));
$now = $nom_jour_fr[$nom_jour] . ' ' . $jour . ' ' . $mois_fr[$mois] . ' ' . $annee;
echo "Nous sommes le  ";
echo $nom_jour_fr[$nom_jour] . ' ' . $jour . ' ' . $mois_fr[$mois] . ' ' . $annee;

echo " Il est ";
echo date("H  \h i \m s");
echo '<br />';
echo date("H") . ' heure ' . date("i") . ' min';
//echo date("H:i:s");  
echo '<br />';
echo $now;
echo '<br />';
//echo $now_fr = "le $nom_jour_fr ".$mois_fr[$mois_fr-1]." $year à ${hour}h${min}m${sec}s";
//echo $lastmodified = "le $day ".$months[$month-1]." $year à ${hour}h${min}m${sec}s";
echo '<br />';
$date1 = strtotime('2018-08-14'); //nbre de secondes ecoulées depuis 1970
//$now   = time();
$date2 = strtotime($now);
$diff_seconde = abs($date1 - $date2); //différences de secondes entre les 2 dates

$diff_heure = floor($diff_seconde / (60 * 60));

$resteJ = floor($diff_seconde / (60 * 60 * 24));
$diff_jour = $diff_jour - $resteJ * 60 * 60 * 24;
$val = floor($diff_seconde);

echo 'val ' . $val;
echo '<br />';
echo 'différence ' . $diff_seconde . ' secondes';
echo '<br />';
echo 'différence ' . $diff_heure . ' heures';
echo '<br />';
echo 'différence ' . $diff_jour . ' jours';
echo '<br />';


////////////corrigé/////////
/* Affichage de la date actuelle */
date_default_timezone_set("Europe/Paris");
$now = date("d/m/Y");
$hnow = date("h:i:s");

/* Calcul de la date future */
$date_future = strtotime("2018-06-21");
$date_actuelle = strtotime("now");
$date_passee = "2017-08-21";
$ate_passee = strtotime($ate_passee);

/* Calcul du nombre de secondes de différence */
$diff = $date_future - $date_actuelle;
$diffpassee = abs($date_passee - $date_actuelle);
/* Calcul du nombre de jours de différence */
$resteJ = floor($diff / ( 60 * 60 * 24));
$diff = $diff - $resteJ * ( 60 * 60 * 24);

$resteJ2 = floor($diffpassee / ( 60 * 60 * 24));
$diffpassee = $diffpassee - $resteJ * ( 60 * 60 * 24);

/* Calcul du nombre d'heures de différence restant */
$resteH = floor($diff / ( 60 * 60 ));
$diff = $diff - $resteH * ( 60 * 60 );

$resteH2 = floor($diffpassee / ( 60 * 60 ));
$diffpassee = $diffpassee - $resteH2 * ( 60 * 60 );
/** calcul du nombre de minutes et de secondes   * */
$resteM = floor($diff / 60);

$resteM2 = floor($diffpassee / 60);
/** calcul du nombre de minutes et de secondes   * */
$resteS = $diff - $resteM2 * 60;

$resteS2 = $diffpassee - $resteM2 * 60;
/* Affichage du temps restant */
$futur = date("d/m/Y", $date_future);
$tempsRestant = 'Il reste ' . $resteJ . ' jours, ' . $resteH . ' heures, ' . $resteM . ' minutes et ' . $resteS . ' secondes avant le ' . $futur . '</p>';

$futur2 = date("d/m/Y", $date_passee);
$tempsRestant2 = 'Il reste ' . $resteJ2 . ' jours, ' . $resteH2 . ' heures, ' . $resteM2 . ' minutes et ' . $resteS2 . ' secondes avant le ' . $futur2 . '</p>';


////////fin  corrige///////////
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
        <title></title>
    </head>
    <body>

        <?php
        echo '<br />';
        echo date('l \t\h\e jS');
        echo '<br />';

        echo $tomorrow = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y"));
        echo '<br />';
        echo $today1 = date("F j, Y, g:i a");
// March 10, 2001, 5:16 pm
        echo '<br />';
        echo $today2 = date("m.d.y");
// 03.10.01
        echo '<br />';
        echo $today3 = date("j, n, Y");
// 10, 3, 2001
        echo '<br />';
        echo $today4 = date("Ymd");
// 20010310
        echo '<br />';
        echo $today5 = date('h-i-s, j-m-y, it is w Day');
// 05-16-18, 10-03-01, 1631 1618 6 Satpm01
        echo '<br />';
        echo $today6 = date('\i\t \i\s \t\h\e jS \d\a\y.');
// it is the 10th day.
        echo '<br />';
        echo $today7 = date("D M j G:i:s T Y");
// Sat Mar 10 17:16:18 MST 2001
        echo '<br />';
        echo $today8 = date('H:m:s \m \i\s\ \m\o\n\t\h');
// 17:03:18 m is month
        echo '<br />';
        echo $today9 = date("H:i:s");
// 17:16:18
        echo '<br />';
        echo $today10 = date("Y-m-d H:i:s");                   // 2001-03-10 17:16:18 (the MySQL DATETIME format)
        echo '<br />';
//echo $today10;
        echo '<br />';

        echo '<br />';

//////corrige///////
        ?>   
        //////corrige///////
        <h1>TP 01 Date</h1>
        <p>Nous sommes le <?php echo $now; ?>, il est  <?php echo $hnow; ?></p>
        <p><?php echo $tempsRestant2; ?></p>

        ////// fin corrige///////

        <?php
        ?>
    </body>
</html>

