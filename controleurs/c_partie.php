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

        $partie= new Partie($nbJoueur,$pays,$nomPartie);
        
        Partie::add($partie);
        include("vues/v_salonPartie.php");
        $_SESSION['joueur']->setPartie_id($partie->getId());
        echo $_SESSION['joueur']->getPartie_id();
        Joueur::update($_SESSION['joueur']);
        break;
    }
    case 'PartieInProgress':{
        include("vues/v_Partie.php");
    }

}