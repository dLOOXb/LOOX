$(document).ready(function(){

	$.getJSON("http://localhost:8888/loox/backend/profil.php", function(data){
				$("#username").val(data.anvandarnamn);
				$("#firstname").val(data.fornamn);
				$("#phonenumber").val(data.tel);
				$("#lastname").val(data.efternamn);
				$("#email").val(data.email);

	});

	// Förberedelse för logut
	$("#logUt").click(function(e){
	    e.preventDefault();
	    var logut = 1;
	    var usernameLog = $("#navbar-username").val();

	    $.post( "http://localhost:8888/loox/backend/logut.php", {anvandarnamn: usernameLog, loggout: logut} )
	        .done(function(data ) {
	           localStorage.removeItem("username");
	           localStorage.removeItem("email");
	           localStorage.removeItem("phonenumber");
	           localStorage.removeItem("firstname");
	           localStorage.removeItem("lastname");
	           localStorage.setItem("loggedIn", false);
	           window.location = "index.html" //Reload page when logged out
	        });

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
