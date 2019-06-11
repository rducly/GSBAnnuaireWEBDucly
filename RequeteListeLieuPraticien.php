<?php


	
	// Connexion à la base de données
	include_once('connexionBDD.php');

	
	//  Récupération des données dans la BDD

	$requete2 = $dbh->query("SELECT * FROM type_praticien");
	

		
	// récupération du résultat de la requete en tableau 2 dimensions
	$tab_result2 = $requete2->fetchAll();
	
	
	$requete2->closeCursor();
	
	// fermeture de la connexion à la base de données
	//$dbh = null;  
		
		
 ?>