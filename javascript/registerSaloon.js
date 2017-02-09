$(document).ready(function(){

//Läs in webbpolicy.html
$("#webbpolicy").click(function(){
  $.get("./webbpolicy.html", function(data){
    $(".modal-body").html(data);
  });
});

$("#create").click(function(){
/*TODO .has-error*/

  var companyName = $("#companyName").val();
  var email = $("#email").val();
  var phonenumber = $("#phonenumber").val();
  var password = $("#password").val();
  var webbpage = $("#webbpage").val();
  var facebook = $("#facebook").val();
  var instagram = $("instagram").val();
  var twitter = $("twitter").val();
  var pinterest = $("pinterest").val();
  var info = $("info").val();
  var address = $("address").val();
  var postalcode = $("postalcode").val();
  var pastalcity = $("postalcity").val();


//If checkbox is checked, send data
  if(document.getElementById("agree").checked){
    
    $.ajax({
      url: "../backend/register_salong.php?username=",
      data: {salongname : companyName, password : password, email : email,
      tel : phonenumber, hemsida : webbpage, facebook : facebook, twitter : twitter,
    instagram : instagram, pintrest : pinterest, info : info, gata : address, postnummer : postalcode,
  ort : postalcity},
      method: "POST",
      dataType: "JSON"
    }).done(function(data){
      console.log("success!!");
        localStorage.setItem("username", data.username);
        console.log("More success!!");
      }).fail(function(){
        console.log("Failed");
      });
    }

    else {
      alert("Du måste godkänna användarvillkoren!");
    }
  }); //Close click

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



});
