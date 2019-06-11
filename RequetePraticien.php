<?php

	

	// fonction qui permet de récupérer la liste des spécialités des praticiens
	function requeteSpePrat() {
		// Connexion à la base de données
		//include_once('connexionBDD.php');
		
		//  récupération des données dans la BDD
		$requete = $dbh->query("SELECT * FROM specialite");
			
		// récupération du résultat de la requete en tableau 2 dimensions
		$tab_result = $requete->fetchAll();
		
		// on ferme le curseur (pointeur) de $requete
		$requete->closeCursor();
		
		// on retourne le résultat de la requete
		return $tab_result;
		 
	}	
	
	// fonction qui permet de récupérer la liste des départements
	function requeteDepartements(){
	
		// Connexion à la base de données
		//include_once('connexionBDD.php');
	
		//  Récupération des données dans la BDD
		$requete1 = $dbh->query("SELECT DISTINCT SUBSTR(PRA_CP_PRATICIEN, 1,2) as Departements FROM listepatriciens ORDER BY PRA_CP_PRATICIEN");
		
		// récupération du résultat de la requete en tableau 2 dimensions
		$tab_result1 = $requete1->fetchAll();

		// on ferme le curseur (pointeur) de $requete
		$requete1->closeCursor();
		
		// on retourne le résultat de la requete
		return $tab_result1;
	
	}
	
	// fonction qui permet de récupérer la liste des lieux de travail des praticiens
	function requeteLieuPrat(){
		// Connexion à la base de données
		//include_once('connexionBDD.php');
		
		//  Récupération des données dans la BDD
		$requete2 = $dbh->query("SELECT * FROM type_praticien");
		
		// récupération du résultat de la requete en tableau 2 dimensions
		$tab_result2 = $requete2->fetchAll();
		
		// on ferme le curseur (pointeur) de $requete2
		$requete2->closeCursor();
		
		// on retourne le résultat de la requete
		return $tab_result2;
	}	
 ?>