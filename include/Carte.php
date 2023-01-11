<?php

class Carte {
    private int $carte_id;
    private string $nom;
    private ?string $description = null;
    private ?string $image = null;
    private ?string $power = null;


    public function getId() {
        return $this->carte_id;
    }

    public function setId($id) {
        $this->carte_id = $id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getPower(){
        return $this->power;
    }

    public function setPower($power){
        $this->power = $power;
    }

    /**
     * Obtenir la liste de toutes les cartes.
     * @return array
     */
    public static function getAllCartes() : array
    {
        $sql = "SELECT * FROM carte";
		$rs = PdoGsb::get_monPdo()->query($sql);
        $rs->setFetchMode(PDO::FETCH_CLASS, 'Carte');
        $result = $rs->fetchAll();
		return $result;
    }

    /**
     * Obtenir une carte à partir de son ID.
     * @param int $id
     * @return Carte
     */
    public static function getCarteById($id) : Carte
    {
        $sql = "SELECT * FROM carte WHERE carte_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);
        $rs->setFetchMode(PDO::FETCH_CLASS, 'Carte');
        $rs->bindParam('id', $id);
        $rs->execute();
        $result = $rs->fetch();
		return $result;
    }

    /**
     * Ajouter la carte dans la base de données.
     * @param Carte $carte
     * @return PDOStatement|bool
     */
    public static function add(Carte $carte)
    {
        $sql = "INSERT INTO carte(nom, image, description) VALUES(:nom, :image, :description)";
        $pdo = PdoGsb::get_monPdo();
		$rs = $pdo->prepare($sql);

        $nom = $carte->getNom();
        $image = $carte->getImage();
        $description = $carte->getDescription();
        $rs->bindParam('nom', $nom);
        $rs->bindParam('image', $image);
        $rs->bindParam('description', $description);

        $rs->execute();
        $carte->setId($pdo->lastInsertId());
        return $rs;
    }

    /**
     * Modifier la carte dans la base de données.
     * @param Carte $carte
     * @return PDOStatement|bool
     */
    public static function update(Carte $carte)
    {
        $sql = "UPDATE carte SET nom = :nom, image = :image, description = :description WHERE carte_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);

        $nom = $carte->getNom();
        $image = $carte->getImage();
        $description = $carte->getDescription();
        $id = $carte->getId();
        $rs->bindParam('nom', $nom);
        $rs->bindParam('image', $image);
        $rs->bindParam('description', $description);
        $rs->bindParam('id', $id);

        $rs->execute();
		return $rs;
    }

    /**
     * Supprimer la carte dans la base de données.
     * @param Carte $carte
     * @return PDOStatement|bool
     */
    public static function delete(Carte $carte)
    {
        $sql = "DELETE FROM carte WHERE carte_id = :id";
		$rs = PdoGsb::get_monPdo()->prepare($sql);

        $id = $carte->getId();
        $rs->bindParam('id', $id);

        $rs->execute();
		return $rs;
    }
}