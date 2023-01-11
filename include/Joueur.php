<?php

class Joueur {
    private int $joueur_id;
    private string $pseudo;
    private ?bool $estVivant;
    private ?bool $estMaire;
    private ?bool $estAmoureux;
    private ?int $carte_id;
    private ?string $Email;
    private string $Mdp;
    private ?int $partie_id = null;

    public function getId() {
        return $this->joueur_id;
    }

    public function setId($id) {
        $this->joueur_id = $id;
    }

    public function getPseudo() {
        return $this->pseudo;
    }

    public function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getEstVivant() {
        return $this->estVivant;
    }

    public function setEstVivant($estVivant) {
        $this->estVivant = $estVivant;
    }

    public function getEstMaire() {
        return $this->estMaire;
    }

    public function setEstMaire($estMaire) {
        $this->estMaire = $estMaire;
    }

    public function getEstAmoureux() {
        return $this->estAmoureux;
    }

    public function setEstAmoureux($estAmoureux) {
        $this->estAmoureux = $estAmoureux;
    }

    public function getCarte() : Carte
    {
        return Carte::getCarteById($this->carte_id);
    }

    public function setCarte(Carte $carte) {
        $this->carte_id = $carte->getId();
    }

    public function getPartie() : Partie
    {
        return Partie::getPartieById($this->partie_id);
    }

    public function setPartie(Partie $partie) {
        $this->partie_id = $partie->getId();
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function getMdp() {
        return $this->Mdp;
    }

    public function setMdp($Mdp) {
        $this->Mdp = $Mdp;
    }

    public static function getJoueurById($id) : Joueur
    {
        $sql = "SELECT * FROM joueur WHERE joueur_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $rs->setFetchMode(PDO::FETCH_CLASS, 'Joueur');
        $rs->bindParam('id', $id);
        $rs->execute();
        $result = $rs->fetch();
		return $result;
    }

    /**
     * Ajouter le joueur dans la base de données.
     * @param Joueur $joueur
     * @return PDOStatement|bool
     */
    public static function add(Joueur $joueur)
    {
        $sql = "INSERT INTO joueur(pseudo, estVivant, estMaire, estAmoureux, carte_id, Email, Mdp, partie_id) VALUES(:pseudo, :estVivant, :estMaire, :estAmoureux, :carte_id, :email, :mdp, :partie_id)";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $pseudo = $joueur->getPseudo();
        $rs->bindParam('pseudo', $pseudo);
        $estVivant = $joueur->getEstVivant();
        $rs->bindParam('estVivant', $estVivant);
        $estMaire = $joueur->getEstMaire();
        $rs->bindParam('estMaire', $estMaire);
        $estAmoureux = $joueur->getEstAmoureux();
        $rs->bindParam('estAmoureux', $estAmoureux);
        $carte_id = $joueur->getCarte()->getId();
        $rs->bindParam('carte_id', $carte_id);
        $email = $joueur->getEmail();
        $rs->bindParam('email', $email);
        $mdp = $joueur->getMdp();
        $rs->bindParam('mdp', $mdp);
        $partie_id = $joueur->getPartie()->getId();
        $rs->bindParam('partie_id', $partie_id);
        $rs->execute();
		return $rs;
    }

    /**
     * Modifier le joueur dans la base de données.
     * @param Joueur $joueur
     * @return PDOStatement|bool
     */
    public static function update(Joueur $joueur)
    {
        $sql = "UPDATE joueur SET pseudo = :pseudo, estVivant = :estVivant, estMaire = :estMaire, estAmoureux = :estAmoureux, carte_id = :carte_id, Email = :email, Mdp = :mdp, partie_id = :partie_id WHERE joueur_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $pseudo = $joueur->getPseudo();
        $rs->bindParam('pseudo', $pseudo);
        $estVivant = $joueur->getEstVivant();
        $rs->bindParam('estVivant', $estVivant);
        $estMaire = $joueur->getEstMaire();
        $rs->bindParam('estMaire', $estMaire);
        $estAmoureux = $joueur->getEstAmoureux();
        $rs->bindParam('estAmoureux', $estAmoureux);
        $carte_id = $joueur->getCarte()->getId();
        $rs->bindParam('carte_id', $carte_id);
        $email = $joueur->getEmail();
        $rs->bindParam('email', $email);
        $mdp = $joueur->getMdp();
        $rs->bindParam('mdp', $mdp);
        $id = $joueur->getId();
        $rs->bindParam('id', $id);
        $partie_id = $joueur->getPartie()->getId();
        $rs->bindParam('partie_id', $partie_id);
        $rs->execute();
		return $rs;
    }

    /**
     * Supprimer le joueur dans la base de données.
     * @param Joueur $joueur
     * @return PDOStatement|bool
     */
    public static function delete(Joueur $joueur)
    {
        $sql = "DELETE FROM joueur WHERE joueur_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $id = $joueur->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
		return $rs;
    }
}