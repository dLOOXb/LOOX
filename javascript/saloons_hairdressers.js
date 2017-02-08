$(document).ready(function() {

  $("#companies").click(function (){
    $("#companies").addClass("active-h1");
    $("#companies").removeClass("not-active");
    $("#hairdressers").addClass("not-active");
    $("#hairdressers").removeClass("active-h1");

    //AJAX för att läsa in lista på företag
    $.ajax({
      url:
      data:
      method: "GET",
      dataType: "JSON",

    )}.done(function(data){
      console.log("success!!");
        localStorage.setItem("companyName", data.companyName);
        localStorage.setItem("address", data.address);
        localStorage.setItem("info", data.info);
        localStorage.setItem("website", data.website);
        console.log("More success!!");
    });
  });

  $("#hairdressers").click(function (){
    $("#hairdressers").addClass("active-h1");
    $("#hairdressers").removeClass("not-active");
    $("#companies").addClass("not-active");
    $("#companies").removeClass("active-h1");

    //AJAX för att läsa in lista på frisörer
    $.ajax({
      url:
      data:
      method: "GET",
      dataType: "JSON",

    )}.done(function(data){
      console.log("success!!");
        localStorage.setItem("hairdresserName", data.hairdresserName);
        localStorage.setItem("workTitle", data.workTitle);
        localStorage.setItem("saloon", data.saloon);
        console.log("More success!!");
    });
  });
  });

  $("#tagsDiv > .tag").click(function(){
    $(this).toggleClass("active-tag");
  });


});
