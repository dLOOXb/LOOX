$(document).ready(function(){
	$.getJSON("http://mardby.se/AJK15G/animals_json.php?animalId=2", function(data){
				$("#username").val(data.animal.name);
				$("#firstname").val(data.animal.description);
				$("#phonenumber").val(data.maxAnimalId);
				$("#lastname").val(data.animalId);
				$("#email").val(data.animal.name);
				$("#lastname").val(data.animal.description);


	});



		// Förberedelse för delete
		$("#deleteButton").click(function(e){
		    e.preventDefault();
		    var del = 1;
		    var usernameField = $("#username").val();
		    var passwordField = $("#password").val();
		    
		    $.post( "deleteuser.php", {username: usernameField, password: passwordField, submitDel: del} )
		        .done(function( data ) {
		          if(data.borttagen == 1){ 
		          	 alert("Your account has been deleted");
		            
		          }
		        });

		  });

});
