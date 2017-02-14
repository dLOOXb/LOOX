
$(document).ready(function(){

	// Increase size if mouseover
	$('#twitter').mouseover(function(){
		$(this).css("height", "35px");
		$(this).css("width", "35px");
	})	// Decrease size if mouseleave
	.mouseleave(function(){
		$(this).css("height","25px");
		$(this).css("width", "25px");
	});
	// Increase size if mouseover
	$('#facebook').mouseover(function(){
		$(this).css("height","35px");
		$(this).css("width", "35px");
	})	// Decrease size if mouseleave
	.mouseleave(function(){
		$(this).css("height","25px");
		$(this).css("width", "25px");
	});
		// Increase size if mouseover
	$('#instagram').mouseover(function(){
		$(this).css("height","35px");
		$(this).css("width", "35px");
	})	// Decrease size if mouseleave
	.mouseleave(function(){
		$(this).css("height","25px");
		$(this).css("width", "25px");
	});


	// Kollar radio box
    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    // Sparar värdet som en variabel
    $('input:radio').change(function(){
        var userRating = this.value;
    });


    /*Twitter*/
    window.twttr = (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0],
      t = window.twttr || {};
      if (d.getElementById(id)) return t;
      js = d.createElement(s);
      js.id = id;
      js.src = "https://platform.twitter.com/widgets.js";
      fjs.parentNode.insertBefore(js, fjs);

      t._e = [];
      t.ready = function(f) {
        t._e.push(f);
      };

      return t;
    }
    (document, "script", "twitter-wjs"));

/*
    // Hämtar Namn och kontakt uppgifter till frisören
    $.getJSON("http://mardby.se/AJK15G/animals_json.php?animalId=10",function(data){
    	$("#firstName").html(data.animal.name);
    	$("#yrkestitel").html(data.animal.description);
    	$("#phoneNumber").html(data.maxAnimalId);
    });
	$.getJSON("http://mardby.se/AJK15G/animals_json.php?animalId=7",function(data){
	    	$("#lastName").html(data.animal.name);
	    	$("#salong").html(data.animal.description);
	   		$("#profileImage").attr("src", data.animal.img_src);
	    });*/

});
