<?php

/** 
 * @package default
 * @version    1.0
 */
 /**
 * Teste si un quelconque visiteur est connecté
 * @return bool
 */
function estConnecte(){
  if (isset($_SESSION['id'])) {
	return true;
	
  }
  else{
	return false;
  }
}
/**
 * Enregistre dans une variable session les infos d'un visiteur
 
 * @param $id 
 * @param $nom
 * @param $prenom
 */
function connecter($id,$pseudo,$mail,$mdp){
	$_SESSION['id']= $id; 
	$_SESSION['pseudo']= $pseudo;
	$_SESSION['mail']= $mail;
	$_SESSION['joueur']=Joueur::NewJoueur($id,$pseudo,$mail,$mdp);

}

function verifieEmailPseudo($email,$pseudo){
	$error="";
	echo $email;
	$sql="Select Email From joueur Where Email='$email'";
	$sql2="Select pseudo From joueur Where pseudo='$pseudo'";
	$rs1 = PdoGsb::get_monPdo()->prepare($sql);
	$rs2 = PdoGsb::get_monPdo()->prepare($sql2);
	$ligne1 = $rs1->fetch();
	$ligne2 = $rs2->fetch();
	echo $ligne1;
	if ($ligne1==null && $ligne2==null) {
		return true;
	}
	if ($ligne1!=null) {$error+="Email déjà utilisé.";}
	if ($ligne2!=null) {$error+= "Pseudo déjà utilisé.";}
	return $error;
}


function confirmeInscription($pseudo,$email,$mdp){
	//$mdp = md5($mdp);
	$sql="Insert into joueur(pseudo,email,mdp) VALUES('$pseudo','$email','$mdp')";
	PdoGsb::get_monPdo()->exec($sql);
}

function connexion($pseudo,$mdp){
	//$mdp = md5($mdp);
	$req="SELECT joueur_id,pseudo,email,mdp From joueur where pseudo='$pseudo' AND Mdp='$mdp'";
	$res = PdoGsb::get_monPdo()->query($req);
    $ligne = $res->fetch();
	return $ligne;
}
/**
 * Détruit la session active
 */
function deconnecter(){
	session_destroy();
   
}

	function uploadMsg($message,$idJoueur,$idRoom,$date){
		$sql = "INSERT INTO chats(chatUserid, chatGameid, charText) VALUES('$idJoueur','$idRoom','$message')";
		PdoGsb::get_monPdo()->exec($sql);
	}	

	function dlMsg($idRoom){
		$sql="SELECT pseudo, CharText,date FROM chats, joueur WHERE joueur_id=chatUserid AND chatGameid='$idRoom' ORDER BY date ASC";
		$res = PdoGsb::get_monPdo()->query($sql);
    	$lesLignes = $res->fetchall();
		return $lesLignes;
	}

?>