$(document).ready(function(){


  //Registeration AJAX
    $(".user").submit(function(e){
    e.preventDefault();
    let firstName = $("#firstName").val();
    let lastName = $("#lastName").val();
    let email = $("#email").val();
    let storeName = $("#storeName").val();
    let storeAddress = $("#storeAddress").val();
    let username = $("#username").val();
    let password = $("#password").val();
    let repeatPassword = $("#repeatPassword").val();
    let register = $("#register").val();
     $("#msg").load("config/log.php",{
          firstName: firstName,
          lastName: lastName,
          email: email,
          storeName: storeName,
          storeAddress: storeAddress,
          username: username,
          password: password,
          repeatPassword: repeatPassword,
          register: register
    },function() {
      if ($("#msg div").attr("class") == "alert alert-success my-2") {
        setTimeout(function() {
           window.location.href = "dashboard.php"
        },1000);
      } else {}

    });

   });

// LOgin AJAX
 $("#login").submit(function(e){
        let username = $("#username").val();
        let password = $("#password").val();
        let login =$("#login").val()
        $("#msg").load("config/log.php",{
          username: username,
          password: password,
          login: login
        },function() {
          if ($("#msg div").attr("class") == "alert alert-success my-2") {
            // alert("1");
            setTimeout(function() {
               window.location.href = "dashboard.php"
            },100);
          } else {

          }

        });
        e.preventDefault();
     });
});
