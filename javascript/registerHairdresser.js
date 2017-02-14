$(document).ready(function(){

  //Read webbpolicy.html when it is clicked
  $("#webbpolicy").click(function(){
    $.get("./webbpolicy.html", function(data){
      $(".modal-body").html(data);
    });
  });

$("#create").click(function(event){
event.preventDefault();

    var username = {val:$("#username").val(), id:'#username'};
    var password = {val:$("#password").val(), id:'#password'};
    var email = {val:$("#email").val(), id:'#email'};
    var phonenumber = $("#phonenumber").val();
    var firstname = {val:$("#firstname").val(), id:'#firstname'};
    var lastname = {val:$("#lastname").val(), id:'#lastname'};
    var alias = $("#alias").val();
    var saloon = $("#selSaloon :selected").text();
    var workTitle = $("#selWorkTitle :selected").text();
    var info = {val:$("#info").val(), id:"#info"};
    var facebook = $("#facebook").val();
    var instagram = $("#instagram").val();
    var twitter = $("#twitter").val();
    var pinterest = $("#pinterest").val();
    var arr =[username, password, email, firstname, lastname, info];

    //Add error-class (red border)
    for(var i=0; i<arr.length; i++){
        if(arr[i].val==""){
            alert("Var god fyll i alla röda fält!");
            arr.forEach(function(item){
              if(item.val===""){ //If field is empty add error-class
                $(item.id).addClass("error");
              }
              else //Else delete error-remove
              $(item.id).removeClass("error");
            });
            return;
          }
      }

  //If checkbox is checked, send data
    if(document.getElementById("agree").checked){

      $.ajax({
        url: "http://localhost/loox/backend/register_behandlare.php", //Ändra url
        data: { username : username.val, password : password.val, email : email.val,
        fornamn : firstname.val, efternamn : lastname.val, alias : alias, salongname : saloon,
        titel : workTitle, facebook : facebook, twitter : twitter, instagram : instagram,
        pintrest : pinterest, info : info.val},
        method: "POST",
        dataType: "JSON"
      }).done(function(data){
        console.log("success!!");
          localStorage.setItem("username", data.username);
          localStorage.setItem("email", data.email);
          localStorage.setItem("firstname", data.fornamn);
          localStorage.setItem("lastname", data.efternamn);
          localStorage.setItem("alias", data.alias);
        //localStorage.setItem("companyName", data.salongname);
          localStorage.setItem("title", data.titel);
          localStorage.setItem("facebook", data.facebook);
          localStorage.setItem("twitter", data.twitter);
          localStorage.setItem("instagram", data.instagram);
          localStorage.setItem("pinterest", data.pintrest);
          localStorage.setItem("info", data.info);
          console.log("More success!!");
        }).fail(function(error, tstatus, actualerror){

        console.log(tstatus);
        console.log(actualerror);
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
