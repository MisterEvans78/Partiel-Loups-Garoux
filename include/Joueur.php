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

    // On utilise ici une fonction newJoueur au lieu du __construct
    // car PDO n'utilise pas le constructeur et ça créer une erreur comme quoi il manque des paramètres dans le constructeur
    // https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
    public static function NewJoueur($id, $pseudo, $email,$mdp) {
        $instance = new self;
        $instance->joueur_id=$id;
        $instance->pseudo=$pseudo;
        $instance->Email=$email;
        $instance->Mdp=$mdp;
        $instance-> estMaire=null;
        $instance-> estVivant=null;
        $instance-> estAmoureux=null;
        $instance-> carte_id=null;
        return $instance;
    }
    public function getcarte_id() {
        return $this->carte_id;
    }

    public function setcarte_id($id) {
        $this->carte_id = $id;
    }

    public function getPartie_id() {
        return $this->partie_id;
    }

    public function setPartie_id($id) {
        $this->partie_id = $id;
    }

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
        $sql = "SELECT joueur_id, pseudo, estVivant, estMaire, estAmoureux, carte_id, Email, Mdp, partie_id FROM joueur WHERE joueur_id = :id";
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
        $pdo = PdoGsb::get_monPdo();
		$rs = $pdo->prepare($sql);
    
        $pseudo = $joueur->getPseudo();
        $estVivant = $joueur->getEstVivant();
        $estMaire = $joueur->getEstMaire();
        $estAmoureux = $joueur->getEstAmoureux();
        $carte_id = $joueur->getcarte_id();
        $email = $joueur->getEmail();
        $mdp = $joueur->getMdp();
        $partie_id = $joueur->getPartie_id();
        $rs->bindParam('pseudo', $pseudo);
        $rs->bindParam('estVivant', $estVivant);
        $rs->bindParam('estMaire', $estMaire);
        $rs->bindParam('estAmoureux', $estAmoureux);
        $rs->bindParam('carte_id', $carte_id);
        $rs->bindParam('email', $email);
        $rs->bindParam('mdp', $mdp);
        $rs->bindParam('partie_id', $partie_id);
        $rs->execute();
        $joueur->setId($pdo->lastInsertId());
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
        $id=$joueur->getId();
        $pseudo = $joueur->getPseudo();
        $estVivant = $joueur->getEstVivant();
        $estMaire = $joueur->getEstMaire();
        $estAmoureux = $joueur->getEstAmoureux();
        $carte_id = $joueur->getcarte_id();
        $email = $joueur->getEmail();
        $mdp = $joueur->getMdp();
        $partie_id = $joueur->getPartie_id();
        $rs->bindParam('pseudo', $pseudo);
        $rs->bindParam('estVivant', $estVivant);
        $rs->bindParam('estMaire', $estMaire);
        $rs->bindParam('estAmoureux', $estAmoureux);
        $rs->bindParam('carte_id', $carte_id);
        $rs->bindParam('email', $email);
        $rs->bindParam('mdp', $mdp);
        $rs->bindParam('id', $id);
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