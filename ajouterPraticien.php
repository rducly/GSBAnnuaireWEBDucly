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
		#titre {
			font-size: 20px;
		}
		input {
			width : 300px;
		}
		select {
			width : 300px;
		}
		body	{
			background-color : lightblue;
		}
		
    </style>
	
	<script type="text/javascript" src="js/connexion.js"></script>
	
  </head>
  
  <body>

  
	<center><IMG src="logoGSB.png"></center>
	
	<h2>Bienvenue M. ou Mme </h2>
	
	<?php
		echo '<h2>'.$_COOKIE["utilisateur"].'</h2>';
	?>
	
	<br> 
	
	<a href="deconnexion.php">se déconnecter</a>
	
	<h1><center>Formulaire pour l'ajout d'un médecin</center></h1>
	
	<br> 
	
	<a href="Accueil.php">Retour à la recherche de praticien</a>
	
    
    <br><br>
	
	<p style="text-align: center;"><b id="titre">Veuillez compléter tous les champs du formulaire suivant</b></p>
	     
   <form name="formulaireAjouter" method="post" action="enregistrerNouvPraticien.php" style="text-align: center;">

		<label for= "idNom"> Nom </label><br>
		<input type="text" name="Nom" id = "idNom" placeholder="nom du praticien"><br><br>
		
		
		<label for= "idPrenom"> Prénom </label><br>
		<input type="text" name="Prenom" id ="idPrenom" placeholder="prénom du praticien"><br><br>
		
		
		<label for= "idAdresse"> Adresse </label><br>
		<input type="text" name="adresse" id="idNom" placeholder=""><br><br>
		
		
		<label for= "idCP"> Code postal </label><br>
		<input type="text" name="CP" id = "idCP" placeholder=""><br><br>
		
		
		<label for= "idVille"> Ville </label><br>
		<input type="text" name="Ville" id = "idVille" placeholder=""><br><br>
		
		
		<label for= "idCoefNot"> Coefficient de notoriété </label><br>
		<input type="number" step="0.5" min="0" max="10" name="CoefNot" id = "idCoefNot" placeholder="0.0"><br><br>
		
		
		<label for= "idTel"> Téléphone </label><br>
		<input type="text" name="Tel" id = "idTel" placeholder=""><br><br>
		
		<label for= "idDiplome"> Diplome </label><br>
		<input type="text" name="Diplome" id = "idDiplome" placeholder=""><br><br>
		
		<label for= "idCoefPres"> Coefficient de prescription </label><br>
		<input type="number" step="0.5" min="0" max="10" name="CoefPres" id = "idCoefPres" placeholder="0.0"><br><br>
		
		
		<label for= "idLieu"> Lieu de travail </label><br><br>
		<select name="LieuTravail" id="idLieu" style="margin-right: 15px;">
			<option></option>
			<?php
				// On récupère la liste des lieux de travail des praticiens de la BDD
				//include_once('RequetePraticien.php');
				//$tab_result2 = requeteLieuPrat();
				include_once('RequeteListeLieuPraticien.php');
				
				// on insere le résultat dans une liste déroulante
				foreach ($tab_result2 as $r2) {
		
					echo '<option value='.$r2["TYP_CODE_TYPE_PRATICIEN"].'>'.$r2["TYP_LIEU_TYPE_PRATICIEN"].'</option>';
					
				}
			?>
		
			 
		</select>
		<br><br>
		<label for= "idSpe"> Spécialité du praticien </label><br><br>
		<select name="Specialite" id = "idSpe" style="margin-right: 15px;">
			<option></option>
			<?php
				// On récupère la liste des spécialités des praticiens de la BDD
				//include_once('RequetePraticien.php');
				//$tab_result = requeteSpePrat();
				include_once('RequeteListeSpecialitePraticien.php');
				
				// on insere le résultat dans une liste déroulante
				foreach ($tab_result as $r) {
		
					echo '<option value='.$r["SPE_CODE_SPECIALITE"].'>'.$r["SPE_LIBELLE_SPECIALITE"].'</option>';
					
				}
			?>
		
			 
		</select>
		<br> <br>
		<input type="button" value="Enregistrer" onclick="controllerAjout()"></button>
		
   </form> 

		
  </body>
</html>