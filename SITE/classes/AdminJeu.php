<?php
//cette classe permet de gerer la partie back-Office du site 
class AdminJeu {

    private $date_debut_jeu,
            $date_fin_jeu,
            $id_dates_jeu;

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
