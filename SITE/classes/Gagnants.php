<?php

/**
 * Description de gagnants
 * modif le 8/11
 * @author fd
 */
class Gagnants {

    private $gagnant_Id;
    private $client_Id;
    private $dateGain;
    private $lot_Id;
    private $id_dates_jeux;

    //constructeur
    //    //
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

    /* définition des getters de la classe Gagnants */

    function getGagnant_Id() {
        return $this->gagnant_Id;
    }

    function getClient_Id() {
        return $this->client_Id;
    }

    function getDateGain() {
        return $this->dateGain;
    }

    function getLot_Id() {
        return $this->lot_Id;
    }

      function getId_dates_jeux() {
        return $this->id_dates_jeux;
    }
    /* définition des setters de la classe Gagnants */

    function setGagnant_Id($gagnant_Id) {
        $this->gagnant_Id = $gagnant_Id;
    }

    function setClient_Id($client_Id) {
        $this->client_Id = $client_Id;
    }

    function setDateGain($dateGain) {
        $this->dateGain = $dateGain;
    }

    function setLot_Id($lot_Id) {
        $this->lot_Id = $lot_Id;
    }
    
  function setId_dates_jeux( $id_dates_jeux) {
        $this-> id_dates_jeux=  $id_dates_jeux;
    }
    
}
