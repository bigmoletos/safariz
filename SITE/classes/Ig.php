<?php

 class ig {

    private $erreurs = [],
            $id,
            $label,
            $timestamp,
            $jour,
            $heure,
            $datetime;
    
    function getErreurs() {
        return $this->geterreurs;
    }

    function getId() {
        return $this->getid;
    }

    function getLabel() {
        return $this->getlabel;
    }

    function getTimestamp() {
        return $this->gettimestamp;
    }

    function getJour() {
        return $this->getjour;
    }

    function getHeure() {
        return $this->getheure;
    }

    function getDatetime() {
        return $this->getdatetime;
    }

   

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
 }
        
/* }
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>