<?php

class Ig {

private $erreurs = [],
 $id,
 $label,
 $timestamp,
 $jour,
 $heure,
 $datetime,
 $lotDispo;

//methode constructeur via la fonction hydrate
public function __construct(array $valeurs = []) {
if (!empty($valeurs)) { // Si on a spécifié des valeurs, alors on hydrate l'objet.
$this->hydrate($valeurs);
}
}

/**
 * Méthode assignant les valeurs spécifiées aux attributs correspondant.
 * @param $donnees array Les données à assigner
 * @return void
 */
public function hydrate($donnees) {
foreach ($donnees as $attribut => $valeur) {
$methode = 'set' . ucfirst($attribut);
if (method_exists($this, $methode)) {
$this->$methode($valeur);
}
}
}


// methode getter
function getErreurs() {
return $this->erreurs;
}

function getId() {
return $this->id;
}

function getLabel() {
return $this->label;
}

function getTimestamp() {
return $this->timestamp;
}

function getJour() {
return $this->jour;
}

function getHeure() {
return $this->heure;
}

function getDatetime() {
return $this->datetime;
}

function getLotDispo() {
return $this->lotDispo;
}
// methode setter

function setId($id) {
$this->id = $id;
}

function setLabel($label) {
$this->label = $label;
}

function setTimestamp($timestamp) {
$this->timestamp = $timestamp;
}

function setJour($jour) {
$this->jour = $jour;
}

function setHeure($heure) {
$this->heure = $heure;
}

function setDatetime($datetime) {
$this->datetime = $datetime;
}


function setLotDispo($lotDispo) {
$this->lotDispo = $lotDispo;
}
 }//fin classe

 
?>