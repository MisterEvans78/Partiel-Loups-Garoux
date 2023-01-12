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
        break;
    }
    case 'PartieInProgress':{
        // $partie = Partie::getPartieById($_SESSION['joueur']->getPartie_id());
        // $getJoueursInPartie = Partie::getJoueursInPartie($partie);
        include("vues/v_Partie.php");
        break;
    }
    case 'JoinSalon':{
        $idRoom = $_REQUEST['idRoom'];
        $_SESSION['joueur']->setPartie_id($idRoom);
        Joueur::update( $_SESSION['joueur']);
        $partie = Partie::getPartieById($idRoom);
        $getJoueursInPartie=Partie::getJoueursInPartie($partie); 
       
        include("vues/v_salonPartie.php");
       break;
    }
    case 'getJoueursSalon':{
        $idRoom = $_REQUEST['idRoom'];
        $nbSeconde = $_REQUEST['Sec'];
        echo($nbSeconde);
        $partie = Partie::getPartieById($idRoom);
        $getJoueursInPartie=Partie::getJoueursInPartie($partie); 
       
        include("vues/v_salonPartie.php");
        break;
    }

}
