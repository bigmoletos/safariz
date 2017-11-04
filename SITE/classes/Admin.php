<?php

class Admin {

    private $admin_id,
            $datelastConnexion,
            $login,
            $nomAdm,
            $password;

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
    function getAdmin_id() {
        return $this->admin_id;
    }

    function getDatelastConnexion() {
        return $this->datelastConnexion;
    }

    function getLogin() {
        return $this->login;
    }

    function getNomAdm() {
        return $this->nomAdm;
    }

    function getPassword() {
        return $this->password;
    }

    // methode setter
    function setAdmin_id($admin_id) {
        $this->admin_id = $admin_id;
    }

    function setDatelastConnexion($datelastConnexion) {
        $this->datelastConnexion = $datelastConnexion;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setNomAdm($nomAdm) {
        $this->nomAdm = $nomAdm;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}

?>
