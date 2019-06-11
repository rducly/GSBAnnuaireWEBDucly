<?php
	// Connexion à la base de données
	include_once('connexionBDD.php');
		
	//  récupération des données dans la BDD
	$requete = $dbh->query("SELECT * FROM specialite");
		
	// récupération du résultat de la requete en tableau 2 dimensions
	$tab_result = $requete->fetchAll();
	
	// on ferme le curseur (pointeur) de $requete
	$requete->closeCursor();

	// fermeture de la connexion à la base de données
	//$dbh = null;  
		
		
 ?>