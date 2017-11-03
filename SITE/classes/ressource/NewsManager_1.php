<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NewsManager
 *
 * @author administrateur
 */
class NewsManager {

    /**
     * Attribut contenant l'instance représentant la BDD.
     * @type PDO
     */
    private $db;

    /**
     * Constructeur étant chargé d'enregistrer l'instance de PDO dans l'attribut $db.
     * @param $db PDO Le DAO
     * @return void
     */
    public function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * @see NewsManager::add()
     */
    protected function add(News $news) {
        $requete = $this->db->prepare('INSERT INTO news(auteur, titre, contenu, dateAjout, dateModif, image)'
                . 'VALUES(:auteur, :titre, :contenu, NOW(), NOW(), :image)');
        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':contenu', $news->contenu());
       $requete->bindValue(':image', $news->image());
        $requete->execute();
    }

    /**
     * @see NewsManager::update()
     */
    protected function update(News $news) {
        $requete = $this->db->prepare('UPDATE news SET'
                . ' auteur = :auteur, titre = :titre, contenu = :contenu, dateModif = NOW(), image = :image '
                . 'WHERE id = :id');
        $requete->bindValue(':titre', $news->titre());
        $requete->bindValue(':auteur', $news->auteur());
        $requete->bindValue(':contenu', $news->contenu());
        $requete->bindValue(':image', $news->image());
        $requete->bindValue(':id', $news->id(), PDO::PARAM_INT);
        $requete->execute();
    }

    /**
     * Méthode permettant d'enregistrer une news.
     * @param $news News la news à enregistrer
     * @see self::add()
     * @see self::modify()
     * @return void
     */
    public function save(News $news) {
        if ($news->isValid()) {
            $news->isNew() ? $this->add($news) : $this->update($news);
        } else {
            throw new Exception('La news doit être valide pour être enregistrée');
        }
    }

    /**
     * @see NewsManager::count()
     */
    public function count() {
        $count = $this->db->query('SELECT COUNT(*) FROM news');
        return $count->fetchColumn();
    }

    /**
     * @see NewsManager::delete()
     */
    public function delete($id) {
        $this->db->exec('DELETE FROM news WHERE id = ' . (int) $id);
    }

    /**
     * @see NewsManager::getList()
     */
    public function getList($debut = null, $limite = null) {
        $sql = 'SELECT id, auteur, titre, contenu, dateAjout, dateModif, image FROM news ORDER BY id DESC';

        // On vérifie l'intégrité des paramètres fournis.
        if (!is_null($debut) || !is_null($limite)) {
            $sql .= ' LIMIT ' . (int) $limite . ' OFFSET ' . (int) $debut;
        }  
        $requete = $this->db->query($sql);
        $requete->setFetchMode(PDO::FETCH_CLASS, 'News');
        $listeNews = $requete->fetchAll();
        // On parcourt notre liste de news pour pouvoir placer des instances de DateTime en guise de dates d'ajout et de modification.
        foreach ($listeNews as $news) {
            $news->setDateAjout(new DateTime($news->dateAjout()));
            $news->setDateModif(new DateTime($news->dateModif()));
        }
        $requete->closeCursor();
        return $listeNews;
    }

    /**
     * @see NewsManager::load()
     */
    public function load($id) {
        $requete = $this->db->prepare('SELECT id, auteur, titre, contenu, dateAjout, dateModif, image FROM news WHERE id = :id');
        $requete->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $requete->execute();
        $requete->setFetchMode(PDO::FETCH_CLASS, 'News');
        $news = $requete->fetch();
        $news->setDateAjout(new DateTime($news->dateAjout()));
        $news->setDateModif(new DateTime($news->dateModif()));
        return $news;
    }

}
