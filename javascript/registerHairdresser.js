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

    var username = {val:$("#username").val(), id:'#username'};
    var password = {val:$("#password").val(), id:'#password'};
    var email = {val:$("#email").val(), id:'#email'};
    var phonenumber = $("#phonenumber").val();
    var firstname = {val:$("#firstname").val(), id:'#firstname'};
    var lastname = {val:$("#lastname").val(), id:'#lastname'};
    var alias = {val:$("#alias").val(), id:'#alias'};
    var saloon = $("")
    var workTitle = $("").val();
    var info = {val:$("#info").val(), id:"#alias"};
    var facebook = $("facebook").val();
    var instagram = $("instagram").val();
    var twitter = $("twitter").val();
    var pinterest = $("pinterest").val();
    var arr =[username, password, email, firstname, lastname, alias, info];

    //Loopa igenom och se så att alla obligatoriska fält är ifyllda
    for(var p=0; p<arr.length; p++){
      $(arr[p].id).removeClass("error");
      if(arr[p].val==""){
          $(arr[p].id).addClass("error");
      }
    }
    for(var i=0; i<arr.length; i++){
        if(arr[i].val==""){
            alert("Var god fyll i alla röda fält!");
            return;
          }
      }

  //If checkbox is checked, send data
    if(document.getElementById("agree").checked){

      $.ajax({
        url: "http://localhost/loox/backend/register_behandlare.php", //Ändra url
        data: { username : username, password : password, email : email,
        fornamn : firstname, efternamn : lastname, alias : alias, salongname : saloon,
        facebook : facebook, twitter : twitter, instagram : instagram,
        pintrest : pinterest, info : info},
        method: "POST",
        dataType: "JSON"
      }).done(function(data){
        console.log("success!!");
          localStorage.setItem("username", data.username);
          localStorage.setItem("email", data.email);
          localStorage.setItem("phonenumber", data.tel);
          localStorage.setItem("firstname", data.fornamn);
          localStorage.setItem("lastname", data.efternamn);
          localStorage.setItem("alias", data.alias);
          localStorage.setItem("companyName", data.salongname);
          localStorage.setItem("facebook", data.facebook);
          localStorage.setItem("twitter", data.twitter);
          localStorage.setItem("instagram", data.instagram);
          localStorage.setItem("pinterest", data.pintrest);
          localStorage.setItem("info", data.info);
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
