$(document).ready(function(){

	$('#aboutUsButton').click(function(){
		$.get( "../html/about.html", function( data ) {
			 $( ".main-part" ).html( data );
		});
	});
});