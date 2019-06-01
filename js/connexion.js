function controller(){
	if(document.getElementById("idUtilisateur").value == '')
      {
		 alert("Vous avez omis le nom de l'utilisateur");
		 return false;
      }
	  
	if(document.getElementById("idMdp").value == '')
      {
		 alert("Vous avez omis le mot de passe");
		 return false;
      }
	soumettre();
	return true;
}


function soumettre(){
    document.formulaire.method ="post";
    document.formulaire.action = "connexion.php";
	document.formulaire.submit();
}