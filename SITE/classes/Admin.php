<?php
//cette classe permet de gerer les administrateurs
class Admin {

    private $admin_id,
            $dateLastConnexion,
            $login,
            $nomAdm,
            $email,
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

    function getDateLastConnexion() {
        return $this->dateLastConnexion;
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

     function getEmail() {
        return $this->email;
    }
    // methode setter
    function setAdmin_id($admin_id) {
        $this->admin_id = $admin_id;
    }

    function setDateLastConnexion($dateLastConnexion) {
        $this->dateLastConnexion = $dateLastConnexion;
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
function setEmail($email) {
        $this->email = $email;
    }
    
}

?>
