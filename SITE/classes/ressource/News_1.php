<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of News
 *
 * @author administrateur
 */
class News {

    private $erreurs = [],
            $id,
            $auteur,
            $titre,
            $contenu,
            $dateAjout,
            $dateModif,
            $image;

    /**
     * Constantes relatives aux erreurs possibles rencontrées lors de l'exécution de la méthode.
     */
    const AUTEUR_INVALIDE = 1;
    const TITRE_INVALIDE = 2;
    const CONTENU_INVALIDE = 3;

    /**
     * Constructeur de la classe qui assigne les données spécifiées en paramètre aux attributs correspondants.
     * @param $valeurs array Les valeurs à assigner
     * @return void
     */
    public function __construct(array $valeurs=[]) {
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

    /**
     * Méthode permettant de savoir si la news est nouvelle.
     * @return bool
     */
    public function isNew(){
        return empty($this->id);
    }

    /**
     * Méthode permettant de savoir si la news est valide.
     * @return bool
     */
    public function isValid() {
        return !(empty($this->auteur) || empty($this->titre) || empty($this->contenu));
    }

// SETTERS //

    public function setId($id) {
        $this->id = (int) $id;
    }

    public function setAuteur($auteur) {
        if (!is_string($auteur) || empty($auteur)) {
            $this->erreurs[] = self::AUTEUR_INVALIDE;
        } else {
            $this->auteur = $auteur;
        }
    }

    public function setTitre($titre) {
        if (!is_string($titre) || empty($titre)) {
            $this->erreurs[] = self::TITRE_INVALIDE;
        } else {
            $this->titre = $titre;
        }
    }

    public function setContenu($contenu) {
        if (!is_string($contenu) || empty($contenu)) {
            $this->erreurs[] = self::CONTENU_INVALIDE;
        } else {
            $this->contenu = $contenu;
        }
    }

    public function setDateAjout(DateTime $dateAjout) {
        $this->dateAjout = $dateAjout;
    }

    public function setDateModif(DateTime $dateModif) {
        $this->dateModif = $dateModif;
    }

    public function setImage($image) {
        $this->image = $image;
        
    }

// GETTERS //

    public function erreurs() {
        return $this->erreurs;
    }

    public function id() {
        return $this->id;
    }

    public function auteur() {
        return $this->auteur;
    }

    public function titre() {
        return $this->titre;
    }

    public function contenu() {
        return $this->contenu;
    }

    public function dateAjout() {
        return $this->dateAjout;
    }

    public function dateModif() {
        return $this->dateModif;
    }
    public function image() {
        return $this->image;
    }
}
