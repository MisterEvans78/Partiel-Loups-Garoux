<?php

$action = $_REQUEST['action'];
switch($action){
	case 'connexion':{
		include("vues/v_connexion.php");	
		break;
	}
	case 'inscription':{
		include("vues/v_inscription.php");
		break;
	}
	case 'valideConnexion':{
		$pseudo= $_REQUEST["pseudo"];
		$mdp= $_REQUEST["mdp"];
		$joueur=connexion($pseudo,$mdp);
		if(!is_array( $joueur)){
			//ajouterErreur("Login ou mot de passe incorrect");
			//include("vues/v_erreurs.php");	
			include("vues/v_connexion.php");
		}
		else{
			
			$id = $joueur['joueur_id'];
			$pseudo =  $joueur['pseudo'];
			$mail = $joueur["email"];
			$mdp = $joueur["mdp"];
			connecter($id,$pseudo,$mail,$mdp);
			echo"Connexion réussi";
			header('Location: index.php');	
		}
		break;
	}
	case 'valideInscription':{
		$pseudo= $_REQUEST["Pseudo"];
		$email= $_REQUEST["mail"];
		$mdp= $_REQUEST["mdp"];
		$valideMailPseudo= verifieEmailPseudo($email,$pseudo);
		if ($valideMailPseudo) {
			confirmeInscription($pseudo,$email,$mdp);
			include("vues/v_connexion.php");	
		}
		break;
	}
	case 'deconnexion':{
		deconnecter();
		header('Location: index.php?uc=connexion&action=connexion');
		break;
	}
}
?>