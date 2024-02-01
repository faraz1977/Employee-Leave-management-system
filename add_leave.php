<?php 
require 'top.inc.php';

 

if(isset($_POST['submit'])){
    $employee_id =  $_SESSION['user_id'];
    $leave_id = mysqli_real_escape_string($con,$_POST['leave_id']);
    $leave_from = mysqli_real_escape_string($con,$_POST['leave_from']);
    $leave_to = mysqli_real_escape_string($con,$_POST['leave_to']);
    $leave_description = mysqli_real_escape_string($con,$_POST['leave_desc']);

    $sql="INSERT INTO `leave`(employee_id,leave_id,leave_from,leave_to,leave_desc,leave_status) VALUES('$employee_id','$leave_id','$leave_from','$leave_to','$$leave_description','1')";
    $res= mysqli_query($con,$sql);
    header('location:leave.php');
   }
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
						   
								<div class="form-group">
									<label class=" form-control-label">Leave Type</label>
									<select name="leave_id"  class="form-control">
								<?php  
									$sql=mysqli_query($con,"SELECT * FROM leave_type");
									while($row=mysqli_fetch_assoc($sql)){
									echo "<option value=".$row['id'].">".$row['leave_type']."</option>";
									}
									?>
									</select>
								</div>
							   <div class="form-group">
									<label class=" form-control-label">From Date</label>
									<input type="date" name="leave_from"  class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">To Date</label>
									<input type="date" name="leave_to" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Leave Description</label>
									<input type="text" name="leave_desc" class="form-control" >
								</div>
								
								 <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  
<?php
require('footer.inc.php');
?>