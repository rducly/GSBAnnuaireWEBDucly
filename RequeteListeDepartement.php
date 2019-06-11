<?php
	// Connexion à la base de données
	include_once('connexionBDD.php');

	
	//  Récupération des données dans la BDD

	$requete1 = $dbh->query("SELECT DISTINCT SUBSTR(PRA_CP_PRATICIEN, 1,2) as Departements FROM listepatriciens ORDER BY PRA_CP_PRATICIEN");
	

		
	// récupération du résultat de la requete en tableau 2 dimensions
	$tab_result1 = $requete1->fetchAll();
	
	
	
	// on ferme le curseur (pointeur) de $requete
	$requete1->closeCursor();
	
	// fermeture de la connexion à la base de données
	//$dbh = null;  
		
		
 ?>