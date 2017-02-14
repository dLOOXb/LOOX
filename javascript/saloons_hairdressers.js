$(document).ready(function() {

  $("#companies").click(function (event){
    event.preventDefault();

    $("#companies").addClass("active-h1");
    $("#companies").removeClass("not-active");
    $("#hairdressers").addClass("not-active");
    $("#hairdressers").removeClass("active-h1");

    //AJAX för att läsa in lista på företag
    var url ="http://localhost/loox/backend/saloger.php";
      $.getJSON(url, function(data){
        let htmlText = "";
        for(let item of data){

          htmlText += "<div class='row'><div class='col-md-5 col-sm-5 col-xs-6'>"
          + "<img class='logo' src='../pictures/looxsax.jpg'></div>"
          + "</div><div class='col-md-offset-5 col-sm-offset-5 col-xs-offset-6'>"
          + "<h4><a href='" + item.hemsida + "'>" + item.salong + "</a></h4>"
          + "<p><em>" + item.gata + ", " + item.postnummer + " " + item.ort + "</em></p>"
          + "<p>" + item.info + "</p>"
          + "</div><line></line></div>";

        }
        $("#listData").html(htmlText);
      });
    });

  $("#hairdressers").click(function (event){
    event.preventDefault();

    $("#hairdressers").addClass("active-h1");
    $("#hairdressers").removeClass("not-active");
    $("#companies").addClass("not-active");
    $("#companies").removeClass("active-h1");

    //AJAX för att läsa in lista på frisörer
  /*  var url ="";
      $.getJSON(url, function(data){
        let htmlText;
        for(let item of data){

          htmlText += "<div class='row'><div class='col-md-5 col-sm-5 col-xs-6'>"
          + "<img class='logo' src=''../pictures/sax.jpg'/></div>"
          + "</div><div class='col-md-offset-5 col-sm-offset-5 col-xs-offset-6'>"
          + "<h4><a href='" + item.hemsida + "'>" + item.fornamn + "</a></h4>"
          + "<p><em>" + item.gata + ", " + item.postnummer + " " + item.ort + "</em></p>"
          + "<p>" + item.info + "</p>"
          + "</div><line></line></div>";

        }
        $("#listData").html(htmlText);
      });
  });*/
  });
//Toggle active / not active tag when clicked
  $("#tagsDiv > .tag").click(function(){
    $(this).toggleClass("active-tag");
    //TODO get sorted data from API
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

});
