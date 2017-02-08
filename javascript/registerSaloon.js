$(document).ready(function(){

//Läs in webbpolicy.html
$("#webbpolicy").click(function(){
  $.get("./webbpolicy.html", function(data){
    $(".modal-body").html(data);
  });
});

$("#create").click(function(){
/*TODO .has-error*/

  var username = $("#username").val();


//If checkbox is checked, send data
  if($("agree").checked){
    $.ajax({
      url: "../backend/register_v2.php?username="+username+
      "&password="+password+"&email="+email+"&tel="+phonenumber+
      "&fornamn="+firstname+"&efternamn="+lastname,
      method: "POST",
      dataType: "JSON"
    }).done(function(data){
      console.log("success!!");
        localStorage.setItem("username", data.username);
        console.log("More success!!");
      });
    }

    else {
      alert("Du måste godkänna användarvillkoren!");
    }
  });
});
