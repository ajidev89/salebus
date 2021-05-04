<?php
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_products ORDER BY create_at DESC ";
$result = mysqli_query($conn,$sql);
$Products = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
foreach ($Products as $Product){ ?>
<tr>
<td> <a href="#" data-toggle="modal" data-target="#<?php echo('product'.$Product['id']); ?>"><?php echo htmlspecialchars($Product['prName']);?></a> </td>
<td>&#8358;<?php echo htmlspecialchars($Product['prSellp']); ?></td>
<td>&#8358;<?php echo htmlspecialchars($Product['prCostp']);?></td>
<td><?php echo htmlspecialchars($Product['pr_qty']);  ?></td>
<td><?php echo htmlspecialchars($Product['prCat']);  ?></td>
<td><a href="#" class="btn btn-danger" id="<?php echo('delete'.$Product['id']);?>"><i class="fas fa-trash"></i></a>
  <script src="../vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $("#<?php echo ('delete'.$Product['id']);?>").click(function(e){
    e.preventDefault();
    let id = <?php echo ($Product['id']);  ?>;
    $('.delete').load("pgs/delete.php",{
      id:id
    },function() {
      $("#productTable").load("pgs/mainpr.php",function() {
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
