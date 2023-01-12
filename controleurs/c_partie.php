<?php

$action = $_REQUEST['action'];
switch($action){
    case'voirParties':{
        $lesParties=Partie::lesPartieActive();
        $nbPartie= count($lesParties);
        include("vues/v_recherchePartie.php");
        break;
    }
    case 'CrPartie':{
        if (estConnecte()) {
            include("vues/v_CrPartie.php");
            break;
        }else{
            include("vues/v_connexion.php");
            break;
        }
        
    }
    case 'PartieSalonWaiting':{
        if(estConnecte()) {
            $nomPartie= $_REQUEST["nPartie"];
            $nbJoueur= $_REQUEST["nbJoueur"];
            $pays= $_REQUEST["paysPartie"];
            $partie= Partie::newPartie($nbJoueur,$pays,$nomPartie);
            Partie::add($partie);
            
            $_SESSION['joueur']->setPartie_id($partie->getId());
            echo $_SESSION['joueur']->getPartie_id();
            Joueur::update($_SESSION['joueur']);
            $partie->addJoueurs($_SESSION['joueur']);
            $getJoueursInPartie = Partie::getJoueursInPartie($partie);
    
            include("vues/v_salonPartie.php");
        } else {
            include("vues/v_connexion.php");
        }
        break;
    }
    case 'PartieInProgress':{
        if (estConnecte()) {
            $partie = Partie::getPartieById($_SESSION['joueur']->getPartie_id());
            $getJoueursInPartie = Partie::getJoueursInPartie($partie);
            $joueur = Joueur::getJoueurById($_SESSION['joueur']->getId());
            $getCarteJoueur = Carte::getCarteById($joueur->getcarte_id());
            include("vues/v_Partie.php");
        } else {
            include("vues/v_connexion.php");
        }
        break;
    }
    case 'JoinSalon':{
        if (estConnecte()) {
            $idRoom = $_REQUEST['idRoom'];
            $_SESSION['joueur']->setPartie_id($idRoom);
            Joueur::update( $_SESSION['joueur']);
            $partie = Partie::getPartieById($idRoom);
            $getJoueursInPartie=Partie::getJoueursInPartie($partie); 
           
            include("vues/v_salonPartie.php");
        } else {
            include("vues/v_connexion.php");
        }
       break;
    }
    case 'getJoueursSalon':{
        $idRoom = $_REQUEST['idRoom'];
        $nbSeconde = $_REQUEST['sec'];
       // echo($nbSeconde);
        $partie = Partie::getPartieById($idRoom);
        $getJoueursInPartie=Partie::getJoueursInPartie($partie); 
        $countJ= count($getJoueursInPartie);
            include("vues/v_salonPartie.php");
        break;
    }

}
