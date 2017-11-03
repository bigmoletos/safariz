<?php

//construction de la classe jeu
class Client {

//les noms des attributs doivent etre identiques aux noms rentrees dans la base au moment de sa creation
//c'est pour cela qu'on a enlevé les _ et la premiere maj
    //attributs
    //

    private $client_id;
    private $nom;
    private $prenom;
    private $mail;
    private $adresse;
    private $cp;
    private $ville;
    private $tel;
    private $dateInscription;
    private $session_Id;
    private $newsLetterInscription;

    //constructeur
    //methode setter
    function setClient_id($client_id) {
        $this->client_id = $client_id;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setCp($cp) {
        $this->cp = $cp;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setTel($tel) {
        $this->tel = $tel;
    }

    function setDateInscription($dateInscription) {
        $this->dateInscription = $dateInscription;
    }

    function setSession_Id($session_Id) {
        $this->session_Id = $session_Id;
    }

    function setNewsLetterInscription($newsLetterInscription) {
        $this->newsLetterInscription = $newsLetterInscription;
        }
    
        
    // methode getter
    function getClient_id() {
        return $this->getclient_id;
    }

    function getNom() {
        return $this->getnom;
    }

    function getPrenom() {
        return $this->getprenom;
    }

    function getMail() {
        return $this->getmail;
    }

    function getAdresse() {
        return $this->getadresse;
    }

    function getCp() {
        return $this->getcp;
    }

    function getVille() {
        return $this->getville;
    }

    function getTel() {
        return $this->gettel;
    }

    function getDateInscription() {
        return $this->getdateInscription;
    }

    function getSession_Id() {
        return $this->getsession_Id;
    }

    function getNewsLetterInscription() {
        return $this->getnewsLetterInscription;
    }

    //methode isvalid
      public function isValid(){
    return !(empty($this->nom) or 
            empty($this->prenom) or
            empty($this->mail)  or
            empty($this->adresse) or
            empty($this->ville) or
            empty($this->cp) or
            empty($this->majeur) or
            empty($this->adresse) 
            );
     }
     
     
     
    //methode add
    
    


}
