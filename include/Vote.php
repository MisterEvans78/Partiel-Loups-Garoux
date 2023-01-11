<?php

class Vote {
    private int $vote_id;
    private int $joueur_id;
    private int $joueur_vote; // Le joueur désigné par le vote.
    private int $partie_id;

    public function getId() {
        return $this->vote_id;
    }

    public function setId($id) {
        $this->vote_id = $id;
    }

    public function getJoueur() : Joueur
    {
        return Joueur::getJoueurById($this->joueur_id);
    }

    public function setJoueur(Joueur $joueur) {
        $this->joueur_id = $joueur->getId();
    }

    public function getJoueurVote() : Joueur
    {
        return Joueur::getJoueurById($this->joueur_vote);
    }

    public function setJoueurVote(Joueur $joueurVote) {
        $this->joueur_vote = $joueurVote->getId();
    }

    public function getPartie() : Partie
    {
        return Partie::getPartieById($this->partie_id);
    }

    public function setPartie(Partie $partie) {
        $this->partie_id = $partie->getId();
    }

    public static function getVoteById($id) : Vote
    {
        $sql = "SELECT * FROM vote WHERE vote_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $rs->setFetchMode(PDO::FETCH_CLASS, 'Vote');
        $rs->bindParam('id', $id);
        $rs->execute();
        $result = $rs->fetch();
		return $result;
    }

    /**
     * Ajouter le vote dans la base de données
     * @param Vote $vote
     * @return PDOStatement|bool
     */
    public static function add(Vote $vote)
    {
        $sql = "INSERT INTO vote(joueur_id, partie_id, joueur_vote) VALUES(:joueur_id, :partie_id, :joueur_vote)";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $joueur_id = $vote->getJoueur()->getId();
        $rs->bindParam('joueur_id', $joueur_id);
        $partie_id = $vote->getPartie()->getId();
        $rs->bindParam('partie_id', $partie_id);
        $joueur_vote = $vote->getJoueurVote()->getId();
        $rs->bindParam('joueur_vote', $joueur_vote);
        $rs->execute();
		return $rs;
    }

    /**
     * Modifier le vote dans la base de données
     * @param Vote $vote
     * @return PDOStatement|bool
     */
    public static function update(Vote $vote)
    {
        $sql = "UPDATE vote SET joueur_id = :joueur_id, partie_id = :partie_id, joueur_vote = :joueur_vote WHERE vote_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $joueur_id = $vote->getJoueur()->getId();
        $rs->bindParam('joueur_id', $joueur_id);
        $partie_id = $vote->getPartie()->getId();
        $rs->bindParam('partie_id', $partie_id);
        $joueur_vote = $vote->getJoueurVote()->getId();
        $rs->bindParam('joueur_vote', $joueur_vote);
        $id = $vote->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
		return $rs;
    }

    /**
     * Supprimer le vote dans la base de données
     * @param Vote $vote
     * @return PDOStatement|bool
     */
    public static function delete(Vote $vote)
    {
        $sql = "DELETE FROM vote WHERE vote_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $id = $vote->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
		return $rs;
    }
}
