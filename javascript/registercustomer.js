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
  var password = $("#password").val();
  var email = $("#email").val();
  var phonenumber = $("#phonenumber").val();
  var firstname = $("#firstname").val();
  var lastname = $("#lastname").val();

//If checkbox is checked, send data
  if(document.getElementById("agree").checked){

    $.ajax({
      url: "../backend/register_v2.php?username=",
      data: { username : username, password : password, email : email,
      tel : phonenumber, fornamn : firstname, efternamn : lastname },
      method: "POST",
      dataType: "JSON"
    }).done(function(data){
      console.log("success!!");
        localStorage.setItem("username", data.username);
        localStorage.setItem("email", data.email);
        localStorage.setItem("phonenumber", data.tel);
        localStorage.setItem("firstname", data.fornamn);
        localStorage.setItem("lastname", data.efternamn);
        console.log("More success!!");
      }).fail(function(){
      console.log("Failed");
    });
    
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
