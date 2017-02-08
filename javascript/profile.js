$(document).ready(function(){
	$.getJSON("http://mardby.se/AJK15G/animals_json.php?animalId=2", function(data){
				$("#username").val(data.animal.name);
				$("#firstname").val(data.animal.description);
				$("#phonenumber").val(data.maxAnimalId);
	});
});
