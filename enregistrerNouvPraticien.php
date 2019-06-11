<?php
		// Connexion à la base de données
		include_once('connexionBDD.php');

		// on récupère les valeurs entrées dans le formulaire avec la méthode POST
		// vérification que les variables POST existent et ne sont pas nulles
		if(!empty($_POST["Nom"]) && isset($_POST["Nom"]) && !empty($_POST["Prenom"]) && isset($_POST["Prenom"]) && !empty($_POST["adresse"]) && isset($_POST["adresse"]) && !empty($_POST["CP"]) && isset($_POST["CP"]) && !empty($_POST["Ville"]) && isset($_POST["Ville"]) && !empty($_POST["CoefNot"]) && isset($_POST["CoefNot"]) && !empty($_POST["Tel"]) && isset($_POST["Tel"]) && !empty($_POST["Diplome"]) && isset($_POST["Diplome"]) && !empty($_POST["CoefPres"]) && isset($_POST["CoefPres"]) && !empty($_POST["LieuTravail"]) && isset($_POST["LieuTravail"]) && !empty($_POST["Specialite"]) && isset($_POST["Specialite"]) ) {
			extract($_POST);
			
			//on évite les injections SQL pour protèger notre base de données (htmlspecialchars)
			//"trim" :Pas de caractères spéciaux ni espace
			
			$Nom = htmlspecialchars(trim($_POST["Nom"]));
			$Prenom = htmlspecialchars(trim($_POST["Prenom"]));
			$Adresse = htmlspecialchars(trim($_POST["adresse"]));
			$CP = htmlspecialchars(trim($_POST["CP"]));
			$Ville = htmlspecialchars(trim($_POST["Ville"]));
			$CoefNot = $_POST["CoefNot"];
			$Tel = htmlspecialchars(trim($_POST["Tel"]));
			$Diplome = htmlspecialchars(trim($_POST["Diplome"]));
			$CoefPres = $_POST["CoefPres"];
			$LieuTravail = $_POST["LieuTravail"];
			$Specialite = $_POST["Specialite"];
		
			//RECUPERATION de PRA_NUM_PRATICIEN
			$requeteNumPra = $dbh->query("SELECT MAX(PRA_NUM_PRATICIEN) AS NumPraMax FROM praticien ");
			
			// Vérification de l'execution de la requete
			if($requeteNumPra==null){
				echo 'Erreur l execution de la requete';
				throw new Exception('Erreur lors de l execution de la requete');	
			}
			
			// on insere le résultat dans une liste déroulante
			foreach ($requeteNumPra as $rnum) {
				$NouvNumPraMax = $rnum["NumPraMax"]+1 ;
				}
			
			
			
			//  Insertion des données dans la BDD
			$requeteAjout = $dbh->prepare("INSERT INTO `praticien` (`PRA_NUM_PRATICIEN`, `PRA_NOM_PRATICIEN`, `PRA_PRENOM_PRATICIEN`, `PRA_ADRESSE_PRATICIEN`, `PRA_CP_PRATICIEN`, `PRA_VILLE_PRATICIEN`, `PRA_COEFNOTORIETE_PRATICIEN`, `TYP_CODE_TYPE_PRATICIEN`, `PRA_TELEPHONE_PRATICIEN`) VALUES (:num, :nom, :prenom, :adresse, :cp, :ville, :coefnot, :codetypepraticien, :tel)");
			
			
			// Vérification de la préparation de la requete
			
			if($requeteAjout==null){
				echo 'Erreur preparation de la requete';
				throw new Exception('Erreur lors de la preparation de la requete');	
			}
			
			// on lie la valeur à la variable
			 
			$resA=$requeteAjout->bindValue(':num', $NouvNumPraMax, PDO::PARAM_INT);
			$resA=$requeteAjout->bindValue(':nom', $Nom, PDO::PARAM_STR);
			$resA=$requeteAjout->bindValue(':prenom', $Prenom, PDO::PARAM_STR);
			$resA=$requeteAjout->bindValue(':adresse', $Adresse, PDO::PARAM_STR);
			$resA=$requeteAjout->bindValue(':cp', $CP, PDO::PARAM_STR);
			$resA=$requeteAjout->bindValue(':ville', $Ville, PDO::PARAM_STR);
			$resA=$requeteAjout->bindValue(':coefnot', strval($CoefNot), PDO::PARAM_STR);
			$resA=$requeteAjout->bindValue(':codetypepraticien', $LieuTravail, PDO::PARAM_INT);
			$resA=$requeteAjout->bindValue(':tel', $Tel, PDO::PARAM_STR);
			
				
			// vérification de la préparation de la requete
			if ($resA==null){
				echo 'Erreur lors d Attachement de la variable à la requête';
				throw new  Exception('Erreur lors de l attachement de la variable à la requête'); 	
				}
			
			// verification de l'execution de la requete
			if ($requeteAjout->execute()==false) {
				$requeteAjout->errorInfo(); // récuperation d'infos sur la nature de l'erreur
				echo 'erreur a l execution';
				}
			
			
			
			// Puis on insere les valeurs dans la table posseder
		
			
			//  Insertion des données dans la BDD
			$requeteAjout1 = $dbh->prepare("INSERT INTO `posseder` (`PRA_NUM_PRATICIEN`, `SPE_CODE_SPECIALITE`, `POS_DIPLOME_POSSEDER`, `POS_COEFPRESCRIPTION_POSSEDER`) VALUES (:numpraticien, :codespe, :diplome, :coefprescription )");
			
			
			// Vérification de la préparation de la requete
			
			if($requeteAjout1==null){
				echo 'Erreur preparation de la requete';
				throw new Exception('Erreur lors de la preparation de la requete');	
			}
			
			// on lie la valeur à la variable
			
			$resA1=$requeteAjout1->bindValue(':numpraticien', $NouvNumPraMax, PDO::PARAM_INT);
			$resA1=$requeteAjout1->bindValue(':codespe', $Specialite, PDO::PARAM_INT);
			$resA1=$requeteAjout1->bindValue(':diplome', $Diplome, PDO::PARAM_STR);
			$resA1=$requeteAjout1->bindValue(':coefprescription', strval($CoefPres), PDO::PARAM_STR);
			
				
			// vérification de la préparation de la requete
			if ($resA1==null){
				echo 'Erreur lors d Attachement de la variable à la requête';
				throw new  Exception('Erreur lors de l attachement de la variable à la requête'); 	
				}
			
			// verification de l'execution de la requete
			if ($requeteAjout1->execute()==false) {
				$requeteAjout1->errorInfo(); // récuperation d'infos sur la nature de l'erreur
				echo 'erreur a l execution';
				}
			else {
				echo 'Le nouveau praticien est enregistré';
				echo '<script>window.location.replace("Accueil.php");</script>';
				}
	
			}
		else {
			echo "Veuillez remplir tous les champs.";
			echo '<script>window.location.replace("ajouterPraticien.php");</script>';
			}
	  ?>