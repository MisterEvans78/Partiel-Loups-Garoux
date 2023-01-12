<?php
class Partie {
    private int $partie_id;
    private int $nbNuit = 0;
    private int $nbJoueursMax;
    private ?bool $estTerminer;
    private ?bool $estCommencer;
    private ?string $Pays;
    private ?string $nomPartie;
    private  $joueurs = [];
    private int $timer = 0;

    public function getnbJoueursMax() {
        return $this->nbJoueursMax;
    }

    public function setnbJoueursMax($nbJoueursMax) {
        $this->nbJoueursMax = $nbJoueursMax;
    }

    public function getId() {
        return $this->partie_id;
    }

    public function setId($id) {
        $this->partie_id = $id;
    }

    public function getNbNuit() {
        return $this->nbNuit;
    }

    public function setNbNuit($nbNuit) {
        $this->nbNuit = $nbNuit;
    }

    public function getEstTerminer() {
        return $this->estTerminer;
    }

    public function setEstTerminer($estTerminer) {
        $this->estTerminer = $estTerminer;
    }

    public function getEstCommencer() {
        return $this->estCommencer;
    }

    public function setEstCommencer($estCommencer) {
        $this->estCommencer = $estCommencer;
    }

    public function getJoueurs() {
        return $this->joueurs;
    }

    public function addJoueurs(Joueur $joueurs) {
        $this->joueurs[] = $joueurs;
    }

    public function getPays() {
        return $this->Pays;
    }

    public function setPays($pays) {
        $this->Pays = $pays;
    }

    public function getNomPartie() {
        return $this->nomPartie;
    }

    public function setNomPartie($nom) {
        $this->nomPartie = $nom;
    }

    public function getTimer() {
        return $this->timer;
    }

    public function setTimer($timer) {
        $this->timer = $timer;
    }

    // On utilise ici une fonction newPartie au lieu du __construct
    // car PDO n'utilise pas le constructeur et ça créer une erreur comme quoi il manque des paramètres dans le constructeur
    // https://stackoverflow.com/questions/1699796/best-way-to-do-multiple-constructors-in-php
    public static function newPartie($nbJoueursMax, $pays, $nomPartie) : Partie
    {
        $instance = new self;
        $instance->estTerminer=False;
        $instance->estCommencer=False;
        $instance->nbJoueursMax=$nbJoueursMax;
        $instance->Pays=$pays;
        $instance->nomPartie=$nomPartie;
        return $instance;
    }

    public function debuteLaPartie() {
        $this->setTimer(60);
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
        return count($this->joueurs) >= $this->getnbJoueursMax();
    }

    /**
     * Met fin à la partie
     */
    public function finDePartie() {
        $this->estTerminer = true;
    }

    /**
     * Début de la partie
     */
    public function debutDePartie() {
        $this->estCommencer = true;
    }

    public static function getPartieById($id) : Partie
    {
        $sql = "SELECT partie_id, nbNuit, estTerminer, estCommencer, nbJoueursMax, Pays, nomPartie FROM partie WHERE partie_id = :id";
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
        $sql = "INSERT INTO partie(nbNuit, estTerminer, estCommencer, nbJoueursMax, Pays, nomPartie) VALUES(:nbNuit, :estTerminer, :estCommencer, :nbJoueursMax, :pays, :nomPartie)";
        $pdo = PdoGsb::get_monPdo();
        $rs = $pdo->prepare($sql);

        $nbNuit = $partie->getNbNuit();
        $estTerminer = $partie->getEstTerminer();
        $estCommencer = $partie->getEstCommencer();
        $nbJoueursMax = $partie->getnbJoueursMax();
        $pays = $partie->getPays();
        $nomPartie = $partie->getNomPartie();
        $rs->bindParam('nbNuit', $nbNuit);
        $rs->bindParam(':estTerminer', $estTerminer);
        $rs->bindParam(':estCommencer', $estCommencer);
        $rs->bindParam(':nbJoueursMax', $nbJoueursMax);
        $rs->bindParam(':pays', $pays);
        $rs->bindParam(':nomPartie', $nomPartie);

        $rs->execute();
        $partie->setId($pdo->lastInsertId());
        return $rs;
    }

    /**
     * Modifier la partie dans la base de données.
     * @param Partie $partie
     * @return PDOStatement|bool
     */
    public static function update(Partie $partie) {
        $sql = "UPDATE partie SET nbNuit = :nbNuit, estTerminer = :estTerminer, estCommencer = :estCommencer, nbJoueursMax = :nbJoueursMax, Pays = :pays, nomPartie = :nomPartie WHERE partie_id = :id";
        $rs = PdoGsb::get_monPdo()->prepare($sql);

        $nbNuit = $partie->getNbNuit();
        $estTerminer = $partie->getEstTerminer();
        $estCommencer = $partie->getEstCommencer();
        $nbJoueursMax = $partie->getnbJoueursMax();
        $pays = $partie->getPays();
        $nomPartie = $partie->getNomPartie();
        $id = $partie->getId();
        $rs->bindParam('nbNuit', $nbNuit);
        $rs->bindParam(':estTerminer', $estTerminer);
        $rs->bindParam(':estCommencer', $estCommencer);
        $rs->bindParam(':nbJoueursMax', $nbJoueursMax);
        $rs->bindParam(':pays', $pays);
        $rs->bindParam(':nomPartie', $nomPartie);
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
        $sql = "SELECT joueur_id, pseudo FROM joueur WHERE partie_id = :id";
        $rs = PdoGsb::get_monPdo()->prepare($sql);
        $rs->setFetchMode(PDO::FETCH_CLASS, 'Joueur');
        $id = $partie->getId();
        $rs->bindParam('id', $id);
        $rs->execute();
        $lesJoueurs = $rs->fetchAll();
        return $lesJoueurs;
    }

    /**
     * retournes toutes les parties qui peuvent être rejointent par les joueurs.
     */
    public static function lesPartieActive(){
        $sql="SELECT partie_id, nbJoueursMax, nomPartie, pays FROM partie WHERE estTerminer=false and estCommencer=false";
        $rs = PdoGsb::get_monPdo()->query($sql);
        $results = $rs->fetchAll();
        return $results;
    }

    public static function nbJoueurPartie($idPartie){
        $sql=" SELECT COUNT(*) FROM joueur WHERE partie_id=$idPartie";
        $rs = PdoGsb::get_monPdo()->query($sql);
        $results = $rs->fetch();
        return $results[0];
    }

    
}