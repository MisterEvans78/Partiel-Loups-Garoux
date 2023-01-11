<?php
class Partie {
    private int $partie_id;
    private $joueurs = [];
    private int $nbNuit;
    private int $joueurMin = 6;
    private int $joueurMax = 18;
    private int $timer = 0;

    public function getId() {
        return $this->partie_id;
    }

    public function setId($id) {
        $this->partie_id = $id;
    }

    public function getJoueurs() {
        return $this->joueurs;
    }

    public function getJoueurMin() {
        return $this->joueurMin;
    }

    public function getJoueurMax() {
        return $this->joueurMax;
    }

    public function getNbNuit() {
        return $this->nbNuit;
    }

    public function setNbNuit($nbNuit) {
        $this->nbNuit = $nbNuit;
    }

    public function getTimer() {
        return $this->timer;
    }

    public function setTimer($timer) {
        $this->timer = $timer;
    }

    public function debuteLaPartie() {
        if (count($this->joueurs) >= $this->getJoueurMin()) {
            $this->setTimer(60);
        }
    }

    /**
     * Ajoute un joueur à la partie
     * @param Joueur $joueur
     */
    public function ajouterJoueur(Joueur $joueur) {
        if (!$this->partiePleine()) {
            $this->joueurs[] = $joueur;
        } else {
           // ajouterErreur("La partie que vous essayiez de rejoindre est pleine");
        }
    }

    /**
     * Passe à la nuit suivante
     */
    public function nuitSuivante() {
        $this->nbNuit++;
    }

    /**
     * Vérifie si la partie est pleine
     * @return bool
     */
    public function partiePleine() {
        return count($this->joueurs) >= $this->getJoueurMax();
    }

    /**
     * Met fin à la partie
     */
    public function finDePartie() {
        $this->setNbNuit(0);
        $this->joueurs = [];
    }

    public static function getPartieById($id) : Partie
    {
        $sql = "SELECT * FROM partie WHERE partie_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $rs->setFetchMode(PDO::FETCH_CLASS, 'Partie');
        $rs->bindParam('id', $id);
        $rs->execute();
        $result = $rs->fetch();
		return $result;
    }

    /**
     * Ajouter la partie dans la base de données.
     * @param Partie $partie
     * @return PDOStatement|bool
     */
    public static function add(Partie $partie) {
        $sql = "INSERT INTO partie(nbNuit) VALUES(:nbNuit)";
        $rs = PdoGsb::get_monPdo()->prepare($sql);
        $nbNuit = $partie->getNbNuit();
        $rs->bindParam('nbNuit', $nbNuit);
        $rs->execute();
        return $rs;
    }

    /**
     * Modifier la partie dans la base de données.
     * @param Partie $partie
     * @return PDOStatement|bool
     */
    public static function update(Partie $partie) {
        $sql = "UPDATE partie SET nbNuit = :nbNuit WHERE partie_id = :id";
        $rs = PdoGsb::get_monPdo()->prepare($sql);
        $nbNuit = $partie->getNbNuit();
        $rs->bindParam('nbNuit', $nbNuit);
        $id = $partie->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
        return $rs;
    }

    /**
     * Supprimer la partie dans la base de données.
     * @param Partie $partie
     * @return PDOStatement|bool
     */
    public static function delete(Partie $partie) {
        $sql = "DELETE FROM partie WHERE partie_id = :id";
        $rs = PdoGsb::get_monPdo()->prepare($sql);
        $id = $partie->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
        return $rs;
    }

    /**
     * Recupérer la liste de joueurs d'une partie à partir de la base de données.
     * @param Partie $partie
     * @return array
     */
    public static function getJoueursInPartie(Partie $partie) : array
    {
        $sql = "SELECT joueur_id FROM joueur_partie WHERE partie_id = :id";
        $rs = PdoGsb::get_monPdo()->prepare($sql);
        $id = $partie->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
        $results = $rs->fetchAll();

        $joueurs = [];
        foreach ($results as $result) {
            $joueurs[] = Joueur::getJoueurById($result["joueur_id"]);
        }

        return $joueurs;
    }
}