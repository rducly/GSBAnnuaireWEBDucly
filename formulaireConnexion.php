


<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>ConnexionGSB</title>
	<script type="text/javascript" src="js/connexion.js"></script>
  </head>
  <body>
	
	<p style="text-align: center;"><b id="titre">Authentification </b></p>
	<form name="formulaire" action="connexion.php" method="POST"> <br>
		<IMG src="logo.png">
		<br><br>
		<label for="utilisateur">Identifiant</label>
		<br>
		<input type="text" id="idUtilisateur" name="utilisateur"></input><br>
		<br>
		<label for="Mdp">Mot de passe</label>
		<br>
		<input name="Mdp" id="idMdp" type="password"><br>
		<br>
		<input type="button" value="Se connecter" onclick="controller()"></button>
	</form>
  </body>
</html>
