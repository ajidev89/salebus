<?php 
include('../config/dbconn.php');
include('../config/sessions.php');
$sql = "SELECT * FROM sp_user";
$result = mysqli_query($conn,$sql);

$users = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
//print_r($Products);

foreach($users as $user){  ?>
                      <tr>
                          <td><?php echo htmlspecialchars($user['firstName']);  ?></td>
                          <td><?php echo htmlspecialchars($user['lastName']);  ?></td>
                          <td><?php echo htmlspecialchars($user['username']);  ?></td>
                          <td><?php echo htmlspecialchars($user['email']);  ?></td>
                          <td><?php if ($user['isAdmin'] == 1 ) {?>
                           <a href="#" class="" id="<?php echo('rmadmin'.$user['id']);?>"> Remove admin</a>
                            <script src="../vendor/jquery/jquery.min.js"></script> 
                            <script type="text/javascript">
                                $("#<?php echo ('rmadmin'.$user['id']);?>").click(function(e){
                                e.preventDefault();
                                let rmadmin = <?php echo ($user['id']);?>;
                                $('.delete').load("pgs/product-validate.php",{
                                rmadmin:rmadmin
                               },function() {
                              $("#employee").load("pgs/employtable.php",function() {
                              setTimeout(function() {
                             $(".delete").empty();
                                    },4000);
                                  });
                                });
                              })
                          </script>
                       <?php }else{ ?> 
                            <a href="#" class="" id="<?php echo('mkadmin'.$user['id']);?>">Make admin</a>
                            <script src="../vendor/jquery/jquery.min.js"></script> 
                            <script type="text/javascript">
                                $("#<?php echo ('mkadmin'.$user['id']);?>").click(function(e){
                                e.preventDefault();
                                let mkadmin = <?php echo ($user['id']);?>;
                                $('.delete').load("pgs/product-validate.php",{
                                mkadmin:mkadmin
                               },function() {
                              $("#employee").load("pgs/employtable.php",function() {
                              setTimeout(function() {
                             $(".delete").empty();
                                    },4000);
                                  });
                                });



                              })
                          </script>
                                      
                           
 
                            
                          <?php } ?>
                          </td>
                          <td><?php if ($user['isAdmin'] == 1 ) {?>
                          <?php }else{?>
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

                         <?php  }  ?></td> 
                        </tr>
                  <?php } ?>
                  
                 