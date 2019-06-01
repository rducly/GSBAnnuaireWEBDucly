<?php 

	
	// connexion à la BDD
	include_once('connexionBDD.php');
	
	// si le cookie utilisateur et le pass existe dejà,c'est qu'il est deja connecté
	// donc si l'utilisateur veut aller sur la page d'accueil il sera redirigé vers la page d'accueil
	if (isset($_COOKIE["utilisateur"]) && isset($_COOKIE["pass"])){
		$utilisateur = $_COOKIE["utilisateur"];
		$pass = $_COOKIE["pass"];
	}
	else{
		$utilisateur=$_POST["utilisateur"];
		$pass=$_POST["Mdp"];
	}
	


	//en évitant les injections SQL pour protèger notre base de données (htmlspecialchars)
	 //trim:Pas de caractères spéciaux ni espace
	$utilisateur = htmlspecialchars(trim($utilisateur));
	$pass = htmlspecialchars(trim($pass));

	//  Récupération de l'utilisateur et de son mot de passe
	$req = $dbh->prepare('SELECT VIS_NOM_VISITEUR, VIS_MATRICULE_VISITEUR FROM visiteur WHERE VIS_NOM_VISITEUR = :utilisateur AND VIS_MATRICULE_VISITEUR = :pass');
	$req->execute(array('utilisateur' => $utilisateur, 'pass' => $pass ));
	$resultat = $req->fetch(); //recuperation du resultat
	$dbh = null; //ferme la BDD

	if (!$resultat)
	{
		echo '<script>alert("Mauvais identifiant ou mot de passe !");</script>';
		echo '<script>window.location.replace("formulaireConnexion.php");</script>';
		exit();
	}
	else
	{
		
		
			session_start();
			$_SESSION['utilisateur'] = $utilisateur;
			setcookie('utilisateur', $utilisateur);
			setcookie('pass', $pass);
			echo '<script>window.location.replace("Accueil.php");</script>';
		
	}
?>