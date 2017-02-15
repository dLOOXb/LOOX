$(document).ready(function(){
	$.getJSON("http://localhost:8888/loox/backend/profil.php", function(data){
				$("#username").val(data.anvandarnamn);
				$("#firstname").val(data.fornamn);
				$("#phonenumber").val(data.tel);
				$("#lastname").val(data.efternamn);
				$("#email").val(data.email);

	});

		// Förberedelse för delete
		$("#deleteButton").click(function(e){
		    e.preventDefault();
		    var del = 1;
		    var usernameField = $("#username").val();
		    var passwordField = $("#password").val();

		    $.post( "https://localhost/LOOX/backend/deleteuser.php", {username: usernameField, password: passwordField, submitDel: del} )
		        .done(function( data ) {
		          	 alert("Your account has been deleted");
		        });

		  });

});
