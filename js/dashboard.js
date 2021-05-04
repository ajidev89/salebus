$(document).ready(function(){

     $("#main").load("pgs/main.php");

     $("#notif-log").load("pgs/notif-log.php");

     $("#count-notif").load("pgs/count-notif.php");


     $("#notifdown").click(function(e){count-notif
      e.preventDefault();
       $("#notif-log").load("pgs/notif-log.php");
     });

     $("#dashboard").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/main.php");
     });

   
     $("#allCustomer").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/customers.php");
     });

     $("#addCustomer").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/add-customers.php");
     });
     
     $("#allProducts").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/products.php");
     });

     $("#addProducts").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/add-product.php");
     });

     $("#allCategory").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/category.php");
     });
    
     $("#allEmployee").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/employee.php");
     });

     $("#addEmployee").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/add-employee.php");
     });

     $("#storeInfo").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/about.php");
     });

     $("#upload").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/upload.php");
     });
    
     $("#addCategory").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/add-category.php");
     });

      $("#stock").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/stock.php");
     });

     $("#transactions").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/transactions.php");
     });
     $("#sales").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/sales.php");
     });
     
     $("#notif").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/notification.php");
     });
     $("#Notification").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/notification.php");
     });

     $("#profile").click(function(e){
      e.preventDefault();
      $(".container-fluid").load("pgs/profile.php");
     });



  });
