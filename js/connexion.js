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


function controllerAjout() {
	//var b= Boolean("true");
	for(var i=0;i<document.formulaireAjouter.length;i++)
   {   
         if(document.formulaireAjouter.elements[i].value =='')
		 
	     document.formulaireAjouter.elements[i].value = prompt("Vous avez omis de compléter le champ suivant !\n"+document.formulaireAjouter.elements[i].name+":","");
			 
   }
	
		if(confirm("Le formulaire est complet !\nVoulez-vous enregistrer ce nouveau praticien ?"))
			document.formulaireAjouter.submit(); 	
   }
   
