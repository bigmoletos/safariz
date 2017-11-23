<?php

class AdminJeu {

    private $date_debut_jeu,
        $date_fin_jeu,
        $id_dates_jeu,
        $count_gagnants,
        $gagnants,
        $gagantscsv,
        $participantscsv,
        $count_clients;

    function getCount_gagnants() {
        return $this->count_gagnants;
    }
    function getCount_clients() {
        return $this->count_clients;
    }

    function setCount_gagnants($count_gagnants) {
        $this->count_gagnants = $count_gagnants;
    }
    function setCount_clients($count_clients) {
        $this->count_clients = $count_clients;
    }

    function getGagnants() {
        return $this->gagnants;
    }
    function getClients() {
        return $this->clients;
    }

    function setGagnants($gagnants) {
        $this->gagnants = $gagnants;
    }
    function getCreatecsv() {
        return $this->gagantscsv;
    }
    function getCreatecsvparticipants() {
        return $this->participantscsv;
    }


    //methode constructeur via la fonction hydrate
    public function __construct(array $dates = []) {
        if (!empty($dates)) { // Si on a spécifié des valeurs, alors on hydrate l'objet.
            $this->hydrate($dates);
        }
    }

    /**
     * Méthode assignant les valeurs spécifiées aux attributs correspondant.
     * @param $donnees array Les données à assigner
     * @return void
     */
    public function hydrate($donnees) {
        foreach ($donnees as $attribut => $dates) {
            $methode = 'set' . ucfirst($attribut);
            if (method_exists($this, $methode)) {
                $this->$methode($dates);
            }
        }
    }

    // methode getter
    function getid_dates_jeu() {
        return $this->id_dates_jeu;
    }

    function getdate_debut_jeu() {
        return $this->date_debut_jeu;
    }

    function getdate_fin_jeu() {
        return $this->date_fin_jeu;
    }

    function setdate_fin_jeu($date_fin_jeu) {
        $this->date_fin_jeu = $date_fin_jeu;
    }

    function setdate_debut_jeu($date_debut_jeu) {
        $this->date_debut_jeu = $date_debut_jeu;
    }

}

?>
