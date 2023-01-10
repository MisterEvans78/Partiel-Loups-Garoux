<?php
include("include/Erreur.php");

class Partie {
    private $joueurs = [];
    private int $nbNuit;
    private int $joueurMin = 6;
    private int $joueurMax = 18;
    private int $timer = 0;

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

    public function __construct($nbNuit) {
        $this->nbNuit = $nbNuit;
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
    public function ajouterJoueur($joueur) {
        if (!$this->partiePleine()) {
            $this->joueurs[] = $joueur;
        } else {
            ajouterErreur("La partie que vous essayiez de rejoindre est pleine");
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
}