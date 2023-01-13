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
            $host = $_SESSION['joueur'];
            $partie= Partie::newPartie($nbJoueur,$pays,$nomPartie, $host);
            Partie::add($partie);
            
            $_SESSION['joueur']->setPartie_id($partie->getId());
            echo $_SESSION['joueur']->getPartie_id();
            Joueur::update($_SESSION['joueur']);
            $partie->addJoueurs($_SESSION['joueur']);
            $getJoueursInPartie = Partie::getJoueursInPartie($partie);
    
            include("vues/v_salonPartie.php");
            include("vues/v_chat.php");
        } else {
            include("vues/v_connexion.php");
        }
        break;
    }
    case 'PartieInProgress':{
        if (estConnecte()) {
            $id_partie = $_REQUEST['idPartie'];            
            $partieEstlancer=Partie::partieEstlancer($id_partie);
            echo json_encode($partieEstlancer);
        } else {
            include("vues/v_connexion.php");
        }
        break;
    }
    case 'afficherPartie':{
        $id_partie = $_REQUEST['idPartie'];            
        $partie = Partie::getPartieById($id_partie);
        $getJoueursInPartie = Partie::getJoueursInPartie($partie);
        $getJoueurCarte = Carte::getCarteById(random_int(1, 8));

        $_SESSION['joueur']->setCarte($getJoueurCarte);
        $_SESSION['joueur']->setEstVivant(true);
        $_SESSION['joueur']->setEstMaire(false);
        $_SESSION['joueur']->setEstAmoureux(false);
        Joueur::update($_SESSION['joueur']);
        
        include("vues/v_Partie.php");
        include("vues/v_chat.php");
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
            include("vues/v_chat.php");
        } else {
            include("vues/v_connexion.php");
        }
       break;
    }
    case 'getJoueursSalon':{
        $idRoom = $_REQUEST['idRoom'];
        $nbSeconde = $_REQUEST['sec'];
        $partie = Partie::getPartieById($idRoom);
        $getJoueursInPartie=Partie::getJoueursInPartie($partie); 
        $countJ= count($getJoueursInPartie);
            include("vues/v_salonPartie.php");
        break;
    }

    case'quitterSalon':{
        $_SESSION['joueur']->setPartie_id(null);
        Joueur::update($_SESSION['joueur']);

        $idRoom = $_REQUEST['idRoom'];
        $partie = Partie::getPartieById($idRoom);
        $nbJoueurs = Partie::nbJoueurPartie($idRoom);

        // Si il reste au moins un joueur
        if ($nbJoueurs > 0) {
            // On attribut un nouvel hote
            $partie->newHostAfterExit();
            Partie::update($partie);
        } else {
            // Si il reste personne on supprime la partie
            Partie::delete($partie);
        }

        header('Location: index.php');
        break;
    }

    case 'commencerPartie':{
        $id_partie = $_REQUEST['idPartie'];
        $partie = Partie::getPartieById($id_partie);
        if (!$partie->PartieACommencer()) {
            $partie->setEstCommencer(true); // commencer la partie
            Partie::update($partie);
        }
        break;
    }

}
