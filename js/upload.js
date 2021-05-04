
$("#logo").submit(function(e) {
    e.preventDefault();
    alert("connrct");
    let pic = $("#file").get(0).files[0];
    let picName = pic.name;
    let picExtension = picName.split(".").pop().toLowerCase();
    if (jQuery.inArray(picExtension,['jpg','png','jpeg']) == -1) {
        alert("Invaild Image");
    }
    let picSize = pic.size;
    if (picSize > 2000000) {
      alert("Image file is too big")
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
          $("#alert").html("<span class='text-dark'>Image uploading ...</span> ");
        },
        success:function(){
         $("#alert").html("<span class='text-dark'>Image uploaded</span> ");
         window.location.href = "/chatapp"
        }
     });
    }
    
  });