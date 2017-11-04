<?php

 class ig {

    private $admin_id,
            $datelastConnexion,
            $login,
            $nomAdm,
            $password;
    
    function getAdmin_id() {
        return $this->getadmin_id;
    }

    function getDatelastConnexion() {
        return $this->getdatelastConnexion;
    }

    function getLogin() {
        return $this->getlogin;
    }

    function getNomAdm() {
        return $this->getnomAdm;
    }

    function getPassword() {
        return $this->getpassword;
    }

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
