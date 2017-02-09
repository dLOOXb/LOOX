/*Google maps*/
function initMap(){
  var uluru = {lat: 57.7065, lng: 11.9682};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: uluru
});

var marker = new google.maps.Marker({
  position: uluru,
  map: map
});

/* Förberedelse för att ladda in data på kartan
var urlKarta = "";
$.getJSON(urlKarta, function(data){
  //Loopa igenom all data
  $.each(data, function(key, value) {

    var latLng = new google.maps.LatLng(value.lat, value.lng);

    var marker = new google.maps.Marker({
        position:   latLng,
        map:        map,
        title:      value.name
        if(value.type==="Frisör"){
        label : "F"
      }
    });
*/
});


$(document).ready(function(){
  $('.contact').hide();

  $("#card").flip();
  $("#card2").flip();

/* Facebook
        window.fbAsyncInit = function() {
            FB.init({
              appId      : 'your-app-id',
              xfbml      : true,
              version    : 'v2.8'
            });
            FB.AppEvents.logPageView();
          };
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        */

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
