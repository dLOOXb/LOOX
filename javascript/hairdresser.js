
$(document).ready(function(){
 

	$('#facebook').mouseover(function(){
		$(this).css("height", "35px");
		$(this).css("width", "35px");
	})
	.mouseleave(function(){
		$(this).css("height","25px");
		$(this).css("width", "25px");
	});

	$('#twitter').mouseover(function(){
		$(this).css("height","35px");
		$(this).css("width", "35px");
	})
	.mouseleave(function(){
		$(this).css("height","25px");
		$(this).css("width", "25px");
	});

	$('#instagram').mouseover(function(){
		$(this).css("height","35px");
		$(this).css("width", "35px");
	})
	.mouseleave(function(){
		$(this).css("height","25px");
		$(this).css("width", "25px");
	});


	// Check Radio-box
    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });
    
    // Set value and save it as variable
    $('input:radio').change(function(){
        var userRating = this.value;
        for(var i=0; i<userRating; i++){
        alert(userRating);
    }
    }); 

});