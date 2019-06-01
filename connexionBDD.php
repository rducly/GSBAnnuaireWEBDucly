<?php
Require("param_connexion_bdd.php");  // pour recuperer les données du fichier


		try{
			// connexion à la base de données
			$dbh = new PDO('mysql:host='.$host.';dbname='.$database.'; charset=utf8', $user, $password);
				
		}catch (PDOExeption $e){
			$msg='Erreur PDO : '.$e->getFile().'L.'.$e->getLine().':'.$e->getMessage().' Erreur : Impossible de se connecter à la BDD !';
			die($msg); //stop l'execution du programme si erreur
		}
	
	

?>
















