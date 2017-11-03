<?php
/**
 * Description de gagnants
 *
 * @author JCM
 */
class Gagnants {

    private $gagnant_Id;
    private $client_Id;
    private $dateGain;
    private $lot_Id;

    
    /* définition des getters de la classe Gagnants */
    function getGagnant_Id() {
        return $this->getgagnant_Id;
    }

    function getClient_Id() {
        return $this->getclient_Id;
    }

    function getDateGain() {
        return $this->getdateGain;
    }

    function getLot_Id() {
        return $this->getlot_Id;
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

    

}

