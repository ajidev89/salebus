<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM category ORDER BY id ASC ";
$result = mysqli_query($conn,$sql);

$Categorys = mysqli_fetch_all($result,MYSQLI_ASSOC);
//print_r($Categorys);
mysqli_free_result($result);


foreach ($Categorys as $Category){
  $categoryName = $Category['categoryName'];
  ?>
 <tr>
<td> <a href="#" data-toggle="modal" data-target="#<?php echo('category'.$Category['id']); ?>"><?php
echo $categoryName;?>
  </a></td>
<td><?php
$sql = "SELECT * FROM sp_products WHERE prCat = '$categoryName' ";
$result = mysqli_query($conn,$sql);
$countCategory = mysqli_fetch_all($result,MYSQLI_ASSOC);
//print_r($countCategory);
echo count($countCategory);





?></td>
<td><a href="#" class="btn btn-danger" id="<?php echo('delete'.$Category['id']);?>"><i class="fas fa-trash"></i></a>
  <script src="../vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $("#<?php echo ('delete'.$Category['id']);  ?>").click(function(e){
    e.preventDefault();
    let catid = <?php echo ($Category['id']);  ?>;
    $('.delete').load("pgs/delete.php",{
      catid: catid
    },function() {
      $("#categoryTable").load("pgs/maincat.php",function() {
        setTimeout(function() {
            $(".delete").empty();
        },4000);
      });
    });



  })
</script>

</td>
</tr>
<?php }?>
