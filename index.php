<?php
require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
require_once("include/Carte.php");
require_once("include/Joueur.php");
require_once("include/Partie.php");
require_once("include/Vote.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();

include("vues/v_entete.php");
if(!isset($_REQUEST['uc'])){
     $_REQUEST['uc'] = 'accueil';
}	 
$uc = $_REQUEST['uc'];
switch($uc){
	case 'accueil':{
		include("controleurs/c_accueil.php");
		break;
	}
	case 'connexion':{
		include("controleurs/c_connexion.php");
		break;
	}
	case 'partie':{
		include("controleurs/c_partie.php");
		break;
	}
}
//include("vues/v_pied.php") ;
?>