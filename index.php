<?php
// your code here

require_once("include/fct.inc.php");
require_once("include/class.pdogsb.inc.php");
require_once("include/Carte.php");
require_once("include/Joueur.php");
require_once("include/Partie.php");
require_once("include/Vote.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();

if(empty($_REQUEST['fluxAjax'])){
	include("vues/v_entete.php");
}

if (!isset($_REQUEST['uc'])) {
	$_REQUEST['uc'] = 'accueil';
}

if (!empty($_SESSION['joueur'])) {
	if (!empty($_SESSION['joueur']->getPartie_id()) && empty($_REQUEST['fluxAjax'])) {
		$_SESSION['joueur']->setPartie_id(null);
		$_SESSION['joueur']->setEstVivant(null);
		$_SESSION['joueur']->setEstMaire(null);
		$_SESSION['joueur']->setEstAmoureux(null);
		$_SESSION['joueur']->setcarte_id(null);
		Joueur::update($_SESSION['joueur']);
	}
}


$uc = $_REQUEST['uc'];
switch ($uc) {
	case 'accueil': {
			include("controleurs/c_accueil.php");
			break;
		}
	case 'connexion': {
			include("controleurs/c_connexion.php");
			break;
		}
	case 'partie': {
			include("controleurs/c_partie.php");
			break;
		}
	case 'message': {
			include("controleurs/c_message.php");
			break;
		}
}
if(empty($_REQUEST['fluxAjax'])){
	include("vues/v_pied.php");
}

?>