<?php
/** 
 * Classe d'accès aux données. 
 
 * Utilise les services de la classe PDO
 * Les attributs sont tous statiques,
 * les 4 premiers pour la connexion
 * $monPdo de type PDO 
 * $monPdoGsb qui contiendra l'unique instance de la classe
 */

class PdoGsb{   		
	private static $serveur='mysql:host=loupgarou.mysql.database.azure.com';
	private static $bdd='dbname=loupgarou';   		
	private static $user='webuser' ;    		
	private static $mdp='webuser' ;	
	private static $monPdo;
	private static $monPdoGsb=null;
	/**
	 * Constructeur privé, crée l'instance de PDO qui sera sollicitée
	 * pour toutes les méthodes de la classe
	 */				
	private function __construct(){
    	PdoGsb::$monPdo = new PDO(PdoGsb::$serveur.';'.PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp); 
		PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		PdoGsb::$monPdo = null;
	}
	/**
	 * Fonction statique qui crée l'unique instance de la classe
	 
	* Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
	
	* return l'unique objet de la classe PdoGsb
	*/
	public  static function getPdoGsb(){
		if(PdoGsb::$monPdoGsb==null){
			PdoGsb::$monPdoGsb= new PdoGsb();
		}
		return PdoGsb::$monPdoGsb;  
	}

	public static function get_monPdo(){
		return PdoGsb::$monPdo;
	}
	/**
	 * Retourne les informations d'un visiteur
	 
	* @param $login 
	* @param $mdp
	* return  l'id, le nom et le prénom sous la forme d'un tableau associatif 
	*/
	public function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom, User_Type as type from visiteur 
		where visiteur.login='$login' and visiteur.mdp='$mdp'";
		$rs = PdoGsb::$monPdo->query($req);
		$ligne = $rs->fetch();
		return $ligne;
	}

	
}
?>