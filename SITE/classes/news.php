<?php

//construction de la classe news
class News {
//les noms des attributs doivent etre identiques aux noms rentrees dans la base au moment de sa creation
//c'est pour cela qu'on a enlevé les _ et la premiere maj
    //attributs
    private $id;
    private $auteur;
    private $titre;
    private $contenu;
    private $date_ajout;
    private $date_modif;
    private $image;

    //**************************************// 
    //constructeur à partir de l'hydratation
    public function __construct(array $tuple=[]) {
        //ou if(!empty($tuple)
//        construct recupere le tableau de l'hydratation'
        if (count($tuple)) {
            $this->hydrate($tuple);
        }
    }

    //constructeur methode sans l'hydratation
//    public function __construct($id, $auteur, $titre, $contenu, $date_ajout,$date_modif){
//    $this->id=$id;
//    $this->auteur=$auteur;
//    $this->titre=$titre;
//    $this->contenu=$contenu;
//    $this->date_ajout=$date_ajout;
//    $this->date_ajout=$date_modif;
//    }  
    //destructeur

    public function __destruct() {
        
    }

    //**************************************//
    //methode getter
    public function getId() {
        return $this->id;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function getDate_ajout() {
        return $this->date_ajout;
    }

    public function getDate_modif() {
        return $this->date_modif;
    }

    public function getImage() {
        return $this->image;
    }
    //**************************************//
    //methode setter
//    public function setId($id) {
//        $this->id = $id;
//    }
//
    public function setAuteur($auteur) {
        $this->auteur = $auteur;
    }
//
    public function setTitre($titre) {
        $this->titre = $titre;
    }
//
    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function setDate_ajout($date_ajout) {
        $this->date_ajout = $date_ajout;
    }

    public function setDate_modif($date_modif) {
        $this->date_ajout = $date_modif;
    }
//
//     public function setImage($image) {
//        $this->image = $image;
//    }
    
    //**************************************//
    //versioin david des setter avec controle de saisi
   // SETTERS //

    public function setId($id) {
        $this->id = (int) $id;
    }

//    public function setAuteur($auteur) {
//        if (!is_string($auteur) || empty($auteur)) {
//            $this->erreurs[] = self::AUTEUR_INVALIDE;
//        } else {
//            $this->auteur = $auteur;
//        }
//    }
//$news->Titre()
//    public function setTitre($titre) {
//        if (!is_string($titre) || empty($titre)) {
//            $this->erreurs[] = self::TITRE_INVALIDE;
//        } else {
//            $this->titre = $titre;
//        }
//    }

//    public function setContenu($contenu) {
//        if (!is_string($contenu) || empty($contenu)) {
//            $this->erreurs[] = self::CONTENU_INVALIDE;
//        } else {
//            $this->contenu = $contenu;
//        }
//    }

//    public function setDate_ajout(DateTime $date_ajout) {
//        $this->dateAjout = $date_ajout;
//       
//    }
//
//    public function setDate_modif(DateTime $date_modif) {
//        $this->dateModif = $date_modif;
//    }

    public function setImage($image) {
        $this->image = $image;
    }

    
//    
//    ******************************************
    //autres methodes
    
    //hydratation devient le construteur
    //permet de d'instancier les attributs dans le constructeur c'est un tableau dont 
    //les valeurs changent 
    public function hydrate(array $tuple) {
        //construction dynamique du setter
        foreach ($tuple as $key => $value) {
            // ucfirst() : met tout en minuscule sauf la premiere lettre en Maj
            //on concatene set et la cle avec le format PEAR, pour avoir setNom
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
//version david
//    public function hydrate($donnees) {
//        foreach ($donnees as $attribut => $valeur) {
//            $methode = 'set' . ucfirst($attribut);
//            if (method_exists($this, $methode)) {
//                $this->$methode($valeur);
//            }
//        }
//    }
    
    //methode isvalid(), renvoie vrai si une news est valide, lors de la validation du formulaire
    // va prendre un objet news et va voir  s'il est valide'
    // verifie que la news à bien un auteur, un titre , un contenu
    //on instancie un  objet news        

//    public function isValid(news $news) {
//        //on aurait pu ecrire !(empty($news->Titre) or  empty($news->Auteur) or empty($news->Contenu))
//        if (!empty($news->Titre) and ! empty($news->Auteur) and ! empty($news->Contenu)) {
//
//            echo "bravo la news est valide!";
//            return true;
//        }return false;
//    }

//    ou version david
     public function isValid(){
    return !(empty($this->Titre) or empty($this->Auteur) or empty($this->Contenu));
     }
    
     
    //methode isNews() qui renvoie vrai si une news est nouvelle (pour pouvoir l’enregistrer)
    //         si l'id de l'objet exist retourne faux, il faut verifier dans la base que l'id n'est pas deja dans la base'   
    //il faudra surement faire une boucle
//    public function isNews() {
//        if (empty($this->id)) {
//            echo "bravo la news est nouvelle!";
//            return true;
//        }return false;
//    }
//ou version david
         public function isNews(news $news) {
            return empty($news->id); 
        }
       
   // autre version possible  return (empty($this->id);
    
    //methode permettant de decrire une news
    public function decrireNews() {
        echo' id ' . $this->id . ' titre ' . $this->titre . ' auteur: ' . $this->auteur
        . ' contenu des news: ' . $this->contenu . '<br>' .
        ' date_ajout: ' . $this->date_ajout . ' date_modif: ' . $this->date_modif
        ;
    }

//    *******************************
    
   //cette methode permet d'avoir les dates et heure au format europeen
    public function dateFr($ajout){
       date_default_timezone_set("Europe/Paris");
        //        //donne la date et l'heure d'enregistrement du fichier
        $ajout = date("d/m/Y à H:i:s");
        var_dump($ajout);
       return $ajout;
   }
    
    //methode permettant d'ajouter les news dans le BD si elle est nouvelle  //fichier ayant pour nom nomdeesnews.txt   
    //à mettre dans newsManager
   public function addsNews() {
       $req=$this->db->prepare('
           INSERT TO
           

               ');
    $req->execute();
        // var_dump($req);    
    }

}
