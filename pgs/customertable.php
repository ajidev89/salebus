<?php 
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM customers";
$result = mysqli_query($conn,$sql);

$users = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
//print_r($Products);

foreach($users as $user){  ?>
                      <tr>
                          <td><?php echo htmlspecialchars($user['customerName']);  ?></td>
                          <td><?php echo htmlspecialchars($user['customerPhone']);  ?></td>
                          <td><?php echo htmlspecialchars($user['customerEmail']);  ?></td>
                          <td><?php echo htmlspecialchars($user['gender']);  ?></td>
                          <td>
                            <a href="#" class="btn btn-danger" id="<?php echo('delete'.$user['id']);?>"><i class="fas fa-trash"></i></a>
                              <script src="../vendor/jquery/jquery.min.js"></script>
                              <script type="text/javascript">
                                $("#<?php echo ('delete'.$user['id']);  ?>").click(function(e){
                                e.preventDefault();
                                let employid = <?php echo ($user['id']);  ?>;
                                $('.delete').load("pgs/delete.php",{
                                employid:employid
                               },function() {
                              $("#employee").load("pgs/employtable.php",function() {
                              setTimeout(function() {
                             $(".delete").empty();
                                    },4000);
                                  });
                                });



                              })
                          </script>

                             </td> 
                        </tr>
                  <?php } ?>
                  
                 