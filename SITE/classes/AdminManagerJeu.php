 <?php

class AdminManagerJeu {

    //attribut
    private $db;

    //methode constructeur
    //on met (PDO $db) car on a besoin d'un objet pdo car le new=PDO(......) du connexion fait un objet PDO
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    // methode getter
    public function getDb() {
        return $this->getdb;
    }

    //methode setter
    public function setDb($db) {
        $this->db = $db;
    }

    public function countgagnants() {
        $count = $this->db->query('SELECT COUNT(*) FROM gagnants');
        return (int) $count->fetchColumn();
    }
    public function countclients() {
        $countclients = $this->db->query('SELECT COUNT(*) FROM clients');
        return (int) $countclients->fetchColumn();
    }

    public function listegagnants() {
        $liste = $this->db->query(" SET lc_time_names = 'fr_FR'");
        $req = $this->db->prepare('select clients.mail, clients.nom, clients.prenom, gagnants.gagnant_id, gagnants.dateGain, ig.label from clients inner join gagnants on clients.client_id=gagnants.client_id inner join ig on ig.ID=gagnants.lot_id order by gagnants.dateGain');
        $req->setFetchMode(PDO::FETCH_ASSOC);
        if ($req->execute()) {
            return $req->fetchAll();
        }
    }

    public function ouvertureJeu() {

        $req = $this->db->prepare('SELECT `id_dates_jeux`, `date_debut_jeu`, `date_fin_jeu`'
                . 'FROM `dates_jeux`'
                . 'WHERE `date_debut_jeu` < now() '
                . 'AND `date_fin_jeu` > now()');

        if ($req->execute()) {
            echo "";
        }
        $req->setFetchMode(PDO::FETCH_ASSOC);
        return $req->fetch();
    }

    public function addJeux(AdminJeu $jeu) {
        try {
            //on fait le prepare et on l'affecte Ã  la variable $req
            //on affecte Ã  la variable $req la valeur de l'objet $admin ($this->db) puis on prepare les donnÃ©es        
            //pour mettre les date en francais dans la requete
            $this->db->query(" SET lc_time_names = 'fr_FR'");
            $req = $this->db->prepare('INSERT INTO dates_jeux (date_debut_jeu,  date_fin_jeu)'
                    . ' VALUES (:date_debut_jeu, :date_fin_jeu )');

            $req->bindValue(':date_debut_jeu', $jeu->getdate_debut_jeu());
            $req->bindValue(':date_fin_jeu', $jeu->getdate_fin_jeu());

            echo "<pre>";
            //   var_dump($req);
            echo "</pre>";
            if ($req->execute()) {
                echo "<br/>nouvelles dates correctement insérées en bdd<br/>";
            }

            //version xxxxxx   
            //puis on fait l'execute     
            //insertion des donnÃ©es dans la base     
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
            ////pour afficher les erreurs on peut aussi tenter :
            die(print_r($this->db->errorInfo()));
            ////
        }
    }

    //fonction permettant de verifier le login en cours de saisie dans le formulaire 
    //login en Ajax depuis la table administrateur
    public function verifLogin(Admin $login) {

        $rep = $this->db->query("select login from administrateur ");
        $tab = $req->fetchAll();
        $q = $_REQUEST["q"];
        $indice = "";
        if ($q !== "") {
            $q = strtolower($q);
            $len = strlen($q);
            foreach ($tab as $valeur) {
                if (stristr($q, substr($valeur[0], 0, $len))) {
                    if ($indice === "") {
                        $indice = $valeur[0];
                    } else {
                        $indice .= ", $valeur[0]";
                    }
                }
            }
        }
        echo $indice === "" ? "Pas de suggestion" : $indice;
    }

public function Createcsv(){
    // L'action "c" permet d'ouvrir ou de créer, s'il y a lieu, le fichier et place le curseur en début de fichier
    $gagantscsv = fopen('gagnants.csv', 'c+');

    // Tronquer le fichier à la taille zéro.
    // Est équivalant à écraser le fichier
    ftruncate($gagantscsv,0);

    if($gagantscsv!=false)
    {
        // Récupérer les données de la table
        $req=$db->query('select clients.mail, clients.nom, clients.prenom, gagnants.gagnant_id, gagnants.dateGain, ig.label from clients inner join gagnants on clients.client_id=gagnants.client_id inner join ig on ig.ID=gagnants.lot_id ')  or die (print_r($db->errorInfo()));
        $colonnes = array("Email", "Nom", "Prénom", "id_gagnant","date de jeu", "lot" );
        fputcsv($gagantscsv, $colonnes);
        // Boucle pour lire toutes les entrées retournées par la requête SQL et les écrire dans le fichier CSV
        $req->setFetchMode(PDO::FETCH_ASSOC);
        while($donnees=$req->fetch())
        {
            // Écrire la ligne dans le fichier
            fputcsv($gagantscsv,$donnees);
        }
        $req->closeCursor();
        //fermeture du fichier
        fclose($gagantscsv);
    }else{
        print "Impossible d'ouvrir ou de créer le fichier.";
    }
 }

    public function Createcsvparticipants(){
        // L'action "c" permet d'ouvrir ou de créer, s'il y a lieu, le fichier et place le curseur en début de fichier
        $participantscsv = fopen('participants.csv', 'c+');

        // Tronquer le fichier à la taille zéro.
        // Est équivalant à écraser le fichier
        ftruncate($participantscsv,0);

        if($participantscsv!=false)
        {
            // Récupérer les données de la table
            $req=$db->query('select `client_id` `nom` `prenom` `mail` `adresse` `cp` `ville` `tel` `dateInscription` `newsLetterInscription`from clients ')  or die (print_r($db->errorInfo()));
            $colonnes = array("client_id", "Nom", "Prénom", "mail","adresee", "cp", "ville", "tel", "dateInscription", "newsLetterInscription" );
            fputcsv($participantscsv, $colonnes);
            // Boucle pour lire toutes les entrées retournées par la requête SQL et les écrire dans le fichier CSV
            $req->setFetchMode(PDO::FETCH_ASSOC);
            while($donnees=$req->fetch())
            {
                // Écrire la ligne dans le fichier
                fputcsv($participantscsv,$donnees);
            }
            $req->closeCursor();
            //fermeture du fichier
            fclose($participantscsv);
        }else{
            print "Impossible d'ouvrir ou de créer le fichier.";
        }
    }
//fin fonction verif login
}

//fin classe
?>
