//email
  $("#form-email").submit(function(e){
    e.preventDefault();
    let email = $("#edit-email").val();
    let btnemail= $("#btn-email").val();
    $("#alert-email").load("pgs/product-validate.php",{
       email: email,
       btnemail: btnemail
     });
   });
//username
$("#form-username").submit(function(e){
  e.preventDefault();
  let username = $("#edit-username").val();
  let btnusername= $("#btn-username").val();
  $("#alert-username").load("pgs/product-validate.php",{
    username:username,
     btnusername: btnusername
   });
 });
 //password
 $("#form-password").submit(function(e){
   e.preventDefault();
   let oldpassword = $("#old-password").val();
   let newpassword = $("#new-password").val();
   let btnpassword = $("#btn-password")
   $("#alert-password").load("pgs/product-validate.php",{
      oldpassword: oldpassword,
      newpassword: newpassword,
      btnpassword: btnpassword
    });
  });
