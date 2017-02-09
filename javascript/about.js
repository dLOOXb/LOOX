$(document).ready(function(){

	$('.aboutUs').click(function(){
		$.get( "../html/about.html", function( data ) {
			 $( ".main-part" ).html( data );
		});
	});
});