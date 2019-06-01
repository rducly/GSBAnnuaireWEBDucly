<?php 
	if(!isset($_COOKIE["utilisateur"])) {
	
		echo "vous n'etes pas connecté";
		header('Location: ./formulaireConnexion.php');
		//echo '<script>window.location.replace("formulaireConnexion.php");</script>';
	}
?>



<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Accueil</title>
	<style type="text/css">
	
		#Background {
		background-color: #66ffff;
		}
		#Couleurtxt {
		color: #3333ff;
		}
		
    </style>
  </head>
  
  <body>

  
	<center><IMG src="logo.png"></center>
	
	<h2>Bienvenue M. ou Mme </h2>
	
	<?php
		echo '<h2>'.$_COOKIE["utilisateur"].'</h2>';
	?>
	
	<br> 
	
	<a href="deconnexion.php">se déconnecter</a>
	
	<h1><center>Liste des médecins</center></h1>
	
	
    
    <br>
	

	     
   <form name="formulaireDepartement" method="post" action="Accueil.php">

		<input type="text" name="Rechercher" placeholder="Spécalité médecin" style="margin-right: 15px;">
		Département
		<select name="Departement" style="margin-right: 15px;">

			<option></option>
			<option>56</option>
			<option>42</option> 
			<option>14</option>
			 
		</select>
		
		<button>Rechercher</button>
		<br><br>
   </form> 

	<?php
		// Connexion à la base de données
		include_once('connexionBDD.php');

		// on récupère les valeurs choisies dans 'rechercher' et 'departement' avec la méthode POST
		if(!empty($_POST)) {
			extract($_POST);
			
			// on récupère les valeurs choisies dans 'rechercher' et 'departement'
			//en évitant les injections SQL pour protèger notre base de données (htmlspecialchars)
			 //"trim" :Pas de caractères spéciaux ni espace
			  $Rechercher = htmlspecialchars(trim($_POST["Rechercher"])).'%';
			  $Departement = htmlspecialchars(trim($_POST["Departement"])).'%';
			  echo 'Résultat pour tous les médecins spécialistes '.$_POST["Rechercher"];
			  echo ' pour le ou les département(s): '.$_POST["Departement"];
			
			
			//  Récupération des données dans la BDD
		
			$requete = $dbh->prepare("SELECT * FROM listepatriciens WHERE SPE_LIBELLE_SPECIALITE like :recherche AND PRA_CP_PRATICIEN like :departement");
			
			// Vérification de la préparation de la requete
			if($requete==null){
				echo 'Erreur preparation de la requete';
				throw new Exception('Erreur lors de la preparation de la requete');	
			}
			
			// on lie la valeur à la variable
			$res=$requete->bindValue(':recherche', $Rechercher, PDO::PARAM_STR);
			$res=$requete->bindValue(':departement', $Departement, PDO::PARAM_STR);
			
				
			// vérification de la préparation de la requete
			if ($res==null){
				echo 'Erreur lors d Attachement de la variable à la requête';
				throw new  Exception('Erreur lors de l attachement de la variable à la requête'); 	
			}
			
			// verification de l'execution de la requete
			if ($requete->execute()==false) {
				$requete->errorInfo(); // récuperation d'infos sur la nature de l'erreur
				echo 'erreur a l execution';
				}
				
			// récupération du résultat de la requete en tableau 2 dimensions
			$tab_result = $requete->fetchAll();
			
			
			// on dessine l'entete du tableau (1ere ligne)
			  echo '<table width="70%" border="1" cellpadding="5" cellspacing="5">
					  <tr>
						  
						  <th>Nom</th>
						  <th>Prenom</th>
						  <th>Adresse</th>
						  <th>CP</th>
						  <th>Ville</th>
						  <th>Telephone</th>
						  <th>Specialite</th>
						  
					  </tr>';
			
			
			// on insere le resultat de la requete dans un tableau
			foreach ($tab_result as $r) {
				
			  echo '<tr>
							
						<td>'.$r["PRA_NOM_PRATICIEN"].'</td>
						<td>'.$r["PRA_PRENOM_PRATICIEN"].'</td>
						<td>'.$r["PRA_ADRESSE_PRATICIEN"].'</td>
						<td>'.$r["PRA_CP_PRATICIEN"].'</td>
						<td>'.$r["PRA_VILLE_PRATICIEN"].'</td>
						<td>'.$r["PRA_TELEPHONE_PRATICIEN"].'</td>
						<td>'.$r["SPE_LIBELLE_SPECIALITE"].'</td>
				  </tr>';
			}
			
			echo '</table>';
			
			// on ferme le curseur (pointeur) de $requete
			$requete->closeCursor();
			
			// fermeture de la connexion à la base de données
			$dbh = null;  
		}
		
		
		
	  ?>


		
  </body>
</html>