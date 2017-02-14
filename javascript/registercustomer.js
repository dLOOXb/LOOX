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
  var phonenumber = {val:$("#phonenumber").val(), id:'#phonenumber'};
  var firstname = {val:$("#firstname").val(), id:'#firstname'};
  var lastname = {val:$("#lastname").val(), id:'#lastname'};
  var arr = [username, password, email, firstname, lastname];

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
        url: "http://localhost/loox/backend/register_v2.php", //Ändra url
        data: { username : username.val, password : password.val, email : email.val,
        tel : phonenumber.val, fornamn : firstname.val, efternamn : lastname.val },
        method: "POST"
      }).done(function(data){
        console.log("success!!");
          localStorage.setItem("username", data.username);
          localStorage.setItem("email", data.email);
          localStorage.setItem("phonenumber", data.tel);
          localStorage.setItem("firstname", data.fornamn);
          localStorage.setItem("lastname", data.efternamn);
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
