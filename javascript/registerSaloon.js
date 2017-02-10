$(document).ready(function(){

//Läs in webbpolicy.html
$("#webbpolicy").click(function(){
  $.get("./webbpolicy.html", function(data){
    $(".modal-body").html(data);
  });
});

$("#create").click(function(event){
  event.preventDefault();
/*TODO .has-error*/

  var companyName = {val:$("#companyName").val(), id:'#companyName'};
  var email = {val:$("#email").val(), id:'#email'};
  var phonenumber = {val:$("#phonenumber").val(), id:'#phonenumber'};
  var password = {val:$("#password").val(), id:'#password'};
  var webbpage = {val:$("#webbpage").val(), id:'#webbpage'};
  var facebook = $("#facebook").val();
  var instagram = $("instagram").val();
  var twitter = $("twitter").val();
  var pinterest = $("pinterest").val();
  var info = {val:$("info").val(), id:'#info'};
  var address = {val:$("address").val(), id:'#address'};
  var postalcode = {val:$("postalcode").val(), id:'#postalcode'};
  var pastalcity = {val:$("postalcity").val(), id:'#postalcity'};
  var arr = [companyName, email, password, webbpage, info, address, postalcode, postalcity];

  for(var p=0; p<arr.length; p++){
    $(arr[p].id).removeClass("error");
    if(arr[p].val==""){
        $(arr[p].id).addClass("error");
    }
  }
  for(var i=0; arr.length; i++){
      if(arr[i].val==""){
          alert("Var god fyll i alla röda fält!");
          return;
        }
    }

//If checkbox is checked, send data
  if(document.getElementById("agree").checked){

    $.ajax({
      url: "http://localhost/loox/backend/register_salong.php", //Ändra url
      data: {salongname : companyName, password : password, email : email,
      tel : phonenumber, hemsida : webbpage, facebook : facebook, twitter : twitter,
    instagram : instagram, pintrest : pinterest, info : info, gata : address, postnummer : postalcode,
  ort : postalcity},
      method: "POST",
      dataType: "JSON"
    }).done(function(data){
      console.log("success!!");
      localStorage.setItem("companyName", data.salongname);
      localStorage.setItem("email", data.email);
      localStorage.setItem("phonenumber", data.tel);
      localStorage.setItem("webbpage", data.hemsida);
      localStorage.setItem("facebook", data.facebook);
      localStorage.setItem("twitter", data.twitter);
      localStorage.setItem("instagram", data.instagram);
      localStorage.setItem("pinterest", data.pintrest);
      localStorage.setItem("info", data.info);
      localStorage.setItem("address", data.gata);
      localStorage.setItem("postalcode", data.postnummer);
      localStorage.setItem("postalcity", data.ort);
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
