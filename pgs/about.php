<?php
include('../config/dbconn.php');
include('../config/sessions.php');
 ?>
 <?php 
 $sql = "SELECT * FROM storeinfo";
 $result = mysqli_query($conn,$sql);
 $storeInfo = mysqli_fetch_assoc($result);
 ?>
<div class="py-3"></div>
<form class="user" id="add" method="POST">
  <div class="row">
     <div class="col-sm-6">
         <h1 class="h3 mb-2 text-gray-800">Add Store Information</h1>
          <p class="mb-4">Add store information by filing the form</p>
     </div>
     <div class="col-sm-6 text-right ">
     <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModal">
     <i class="fas fa-download fa-sm text-white-50"></i> 
     Upload logo
         </button>
     </div>
     
       </div>
         <div id="alert"></div>
           <div class="form-group row">
             <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control form-control-user" value="<?php echo $storeInfo['storeName']; ?>" name="sName" id="sName" placeholder="Store Name">
               <div class="text-danger" id="errfirstName" role="alert"></div>
             </div>
             <div class="col-sm-6">
             <input type="text" class="form-control form-control-user" value="<?php echo $storeInfo['storeAddress']; ?>" name="address" id="address" placeholder="Store Address">
             </div>
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" value="<?php echo $storeInfo['email']; ?>" name="email" id="email" placeholder="E-mail">
           </div>
           <div class="form-group">
             <input type="text" class="form-control form-control-user" value="<?php echo $storeInfo['phone']; ?>" name="pName"id="pNumber" placeholder="Phone Number">
           </div>

           <button type="submit" form="add" name="addStoreinfo" id="addStoreinfo" class="btn btn-primary btn-user btn-block "><?php if (empty($storeInfo)) {?>
            Add Store information
        <?php }else{?>Edit Store information<?php } ?></button>
         </form>
      <p class="p-5"></p>
<!-- Edit pprofile picture   -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p id="alert2"></p>
       <form action="" id="logo" method="post">
       <div class="custom-file">
          <input type="file" class="custom-file-input" id="file" date-type="image" data-max-size="2mb" accept=".png, .jpeg, .jpg" id="customFile">
          <label class="custom-file-label" for="customFile">Choose file</label>
        </div>
        <div class="pt-2">
          <input type="submit" class="btn btn-primary" name="Upload" value="Upload" id="upload">
        </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</div>  
         <script type="text/javascript">
           $(document).ready(function(){

           $("#add").submit(function(e){
               e.preventDefault();
               let sName = $("#sName").val();
               let address = $("#address").val();
               let email = $("#email").val();
               let pNumber = $("#pNumber").val();
               let addStoreinfo = $("#addStoreinfo").val()
               $("#alert").load("pgs/product-validate.php",{
                 sName: sName,
                 address: address,
                 email: email,
                 pNumber: pNumber,
                 addStoreinfo: addStoreinfo
               },function() {
                 if ($("#alert div").attr("class") == "alert alert-success my-2") {
                   setTimeout(function() {
                     $("#alert").empty();
                   },4000);
                 } else {
                 }
               });
                 });
           });

         </script>
<script>
  
$("#logo").submit(function(e) {
    e.preventDefault();
    let pic = $("#file").get(0).files[0];
    let picName = pic.name;
    let picExtension = picName.split(".").pop().toLowerCase();
    if (jQuery.inArray(picExtension,['jpg','png','jpeg']) == -1) {
        $("#alert2").html("<div class='alert alert-danger my-2'>Invaild Image format</div> ");
    }else{
      let picSize = pic.size;
      if (picSize > 2000000) {
        alert("Image file is too big")
        $("#alert2").html("<div class='alert alert-danger my-2'>Image file is than greater 2MB</div>");
      }else{
        let formData = new FormData();
        formData.append("file",pic);
        $.ajax({
          url:"pgs/upload-file.php",
          method:"POST",
          data:formData,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            $("#alert2").html("<span class='text-dark'>Logo uploading ...</span> ");
          },
          success:function(){
          $("#alert2").html("<div class='alert alert-success my-2'>Logo Uploaded</div>");
          }
      });
      }
   }
  });
</script> 