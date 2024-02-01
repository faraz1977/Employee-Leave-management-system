<?php 
require 'top.inc.php';

if($_SESSION['role']!=1){
   header('location:add_employee.php?id='.$_SESSION['user_id']);
}


if(isset($_GET['type']) AND $_GET['type'] == 'Delete' AND $_GET['id'] ){
   $id =$_GET['id'];
   $sql= mysqli_query($con,"DELETE FROM employee WHERE id='$id'");
}
$sql= mysqli_query($con,"SELECT * FROM employee where role=2 order by id desc");

?>
<div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Employee Master </h4>
						   <h4 class="box_title_link"><a href="add_employee.php">Add Employee</a> </h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th width="5%">S.No</th>
                                       <th width="5%">ID</th>
                                       <th width="40%">Name</th>
									   <th width="15%">Email</th>
									   <th width="15%">Mobile</th>
                                       <th width="20%"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <?php 
                                    $i=1;
                                    while($row=mysqli_fetch_assoc($sql)){?>
									<tr>
                              <td><?php echo $i ?></td>
									   <td><?php echo $row['id'] ?></td>
                              <td><?php echo $row['name']?></td>
									   <td><?php echo $row['email']?></td>
									   <td><?php echo $row['mobile']?></td>
									   <td><a href="add_employee.php?id=<?php echo $row['id']?>&type=EDIT">Edit</a> <a href="employee.php?id=<?php echo $row['id']?>&type=Delete">Delete</a></td>
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
         
<?php
require('footer.inc.php');
?>