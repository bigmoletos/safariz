<?php
//modif  fd 11 nov
//construction de la classe jeu stockage des infos clients
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
    private $session_id;
    private $ip;
    private $newsLetterInscription;
    private $clientValide;

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

    function setSession_id($session_id) {
        $this->session_id = $session_id;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setNewsLetterInscription($newsLetterInscription) {
        $this->newsLetterInscription = $newsLetterInscription;
    }
    
             function setClientValide($clientValide) {
        $this->ClientValide = $clientValide;
    }
    

    // methode getter
    function getClient_id() {
        return $this->client_id;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getMail() {
        return $this->mail;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCp() {
        return $this->cp;
    }

    function getVille() {
        return $this->ville;
    }

    function getTel() {
        return $this->tel;
    }

    function getDateInscription() {
        return $this->dateInscription;
    }

    function getSession_Id() {
        return $this->session_Id;
    }

    function getIp() {
        return $this->ip;
    }

    function getNewsLetterInscription() {
        return $this->newsLetterInscription;
    }
    
    
     function getClientValide() {
        return $this->clientValide;
    }
    
    //methode isValid verifie que les données à inserer dans le formulaire sont valides
    public function isValidForm() {
        return !(empty($this->nom) or
                empty($this->prenom) or
                empty($this->mail) or
                empty($this->adresse) or
                empty($this->ville) or
                empty($this->cp) or
                empty($this->dateInscription)
                );
        }

        //methode permettant de verifier que le le client est valide
        //pour cela il ne faut pas qu'il ait deja joué le jour meme
         public function isValidClient() {
        if(empty($this->dateInscription)!=date()) {
             return !(empty($this->nom) or
                empty($this->prenom) or
                empty($this->mail) or
                empty($this->clientValide) or
                empty($this->ville) or
                empty($this->cp) or
                empty($this->dateInscription)
                );
         }
        }
        
        //methode NouveauClient verifie que le client n'a pas deja dans la base
        //comme il peut rejouer s'il est deja dans la base il suffira de mettre à jour la date de la nouvelle partie
        public function NouveauClient(){
        return empty($this->mail);
         return empty($this->dateInscription);
        
        
    }

    //methode modification date de jeu modifie la date de la derniere partie
         public function NouvellePartie(){
       
        
        
    }
    
    
    //faire methode qui verifie que le client n'a pas déjà joué le jour même
         public function pasDejaJoueAujourdhui(){
       
        
        
    }
    
    
    
    
    
    
}//fin classe client
