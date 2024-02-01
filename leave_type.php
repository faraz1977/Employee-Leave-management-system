<?php 
require 'top.inc.php';
if(!isset($_SESSION['role'])){
   header('location:login.php');
   die();
}
if(isset($_GET['type']) AND $_GET['type'] == 'Delete' AND $_GET['id'] ){
   $id =$_GET['id'];
   $sql= mysqli_query($con,"DELETE FROM leave_type WHERE id='$id'");
}
$sql= mysqli_query($con,"SELECT * FROM leave_type order by id desc");

?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Leave Type Master </h4>
						   <h4 class="box_title_link"><a href="add_leave_type.php">Add Leave Type</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="70%">Leave Type</th>
                                       <th width="20%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php 
                                    $i=1;
                                    while($row=mysqli_fetch_assoc($sql)){?>
									   <tr>
                              <td><?php echo $i?></td>
                              <td><?php echo $row['id']?></td>
                              <td><?php echo $row['leave_type']?></td>
									   <td><a href="add_leave_type.php?id=<?php echo $row['id']?>&type=edit">Edit</a> <a href="leave_type.php?id=<?php echo $row['id']?>&type=Delete">Delete</a></td>
                                    </tr>
								<?php $i++;
                     }?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
