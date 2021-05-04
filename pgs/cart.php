<?php
include ('../config/dbconn.php');
include ('../config/sessions.php');
$sql = "SELECT * FROM cart ORDER BY id DESC ";
$result = mysqli_query($conn,$sql);
$carts = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
?>

<?php if (!array_filter($carts)) {?>
  <tr>
    <td colspan="4" class="text-center"> No products in the cart</td>
  </tr>
<?php }else{
 foreach ($carts as $cart) {?>
 <tr>
<td><?php echo htmlspecialchars($cart['productName']);?></td>
<td>&#8358;<?php echo htmlspecialchars(number_format($cart['price']));?></td>
<td><?php echo htmlspecialchars($cart['productQty']);?></td>
<td class="text-center">
  <a href="#" data-toggle="modal" data-target="#<?php echo('product'.$cart['id']); ?>" class="text-danger">
  <i class="fas fa-trash"></i></a>
</td>
</tr>

<?php }
}?>

  <tr>
    <td><p><strong>TOTAL</strong></p></td>
    <td colspan="3"><?php
    $sum = 0;

    foreach ($carts as $cart) {
      $toprods  = htmlspecialchars($cart['price']) * htmlspecialchars($cart['productQty']);
      $sum = $sum + $toprods;
    }echo"&#8358;".number_format($sum);
    ?></td>
  </tr>
