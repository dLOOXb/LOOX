$(document).ready(function(){

//Read webbpolicy.html when it is clicked
$("#webbpolicy").click(function(){
  $.get("./webbpolicy.html", function(data){
    $(".modal-body").html(data);
  });
});

$("#create").click(function(event){
  event.preventDefault();

  var companyName = {val:$("#companyName").val(), id:'#companyName'};
  var email = {val:$("#email").val(), id:'#email'};
  var phonenumber = {val:$("#phonenumber").val(), id:'#phonenumber'};
  var password = {val:$("#password").val(), id:'#password'};
  var webbpage = {val:$("#webbpage").val(), id:'#webbpage'};
  var facebook = $("#facebook").val();
  var instagram = $("#instagram").val();
  var twitter = $("#twitter").val();
  var pinterest = $("#pinterest").val();
  var info = {val:$("#info").val(), id:'#info'};
  var address = {val:$("#address").val(), id:'#address'};
  var postalcode = {val:$("#postalcode").val(), id:'#postalcode'};
  var postalcity = {val:$("#postalcity").val(), id:'#postalcity'};
  var arr = [companyName, email, phonenumber, password, webbpage, info, address, postalcode, postalcity];

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
      url: "../backend/register_salong.php", //Ändra url
      data: {salongname : companyName.val, password : password.val, email : email.val,
      tel : phonenumber.val, hemsida : webbpage.val, facebook : facebook, twitter : twitter,
      instagram : instagram, pintrest : pinterest, info : info.val, gata : address.val, postnummer : postalcode.val,
      ort : postalcity.val},
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
