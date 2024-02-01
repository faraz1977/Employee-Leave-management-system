<?php 
require 'top.inc.php';

$msg='';
$department=$id =$name = $email= $mobile= $password= $department_id = $address =$birthday='';
if(isset($_GET['id'])){
   if($_SESSION['user_id']!==$_GET['id'] && $_SESSION['role'] == 2){
      die('ACCESS DENIED');
   }

   $id =$_GET['id'];
   $eid=$_SESSION['user_id'];
   $sql= mysqli_query($con,"SELECT * FROM employee WHERE id='$id' order by id desc");
   $row=mysqli_fetch_assoc($sql);
   $name =$row['name'];
   $email =$row['email'];
   $mobile =$row['mobile'];
   $password =$row['password'];
   $department_id=$row['department_id'];
   $address =$row['address'];
   $birthday =$row['birthday'];

   }

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $mobile = mysqli_real_escape_string($con,$_POST['mobile']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $department_id = mysqli_real_escape_string($con,$_POST['department_id']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $birthday = mysqli_real_escape_string($con,$_POST['birthday']);


   if($id > 0){
       $sql= "UPDATE employee SET name='$name', email='$email', mobile='$mobile', password='$password', department_id='$department_id', address='$address', birthday='$birthday' WHERE id='$id'";
   }else{
      $sql="INSERT INTO employee(name,email,mobile,password,department_id,address,birthday,role) VALUES('$name','$email','$mobile','$password','$department_id','$address','$birthday','2')";
    }
    $res= mysqli_query($con,$sql);
    header('location:employee.php');
   }
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                     <?php if($_SESSION['role']==2){?>
                        <div class="card-header"><strong>YOUR PROFILE</strong><small></small></div>
                        <?php }else{?>
                        <div class="card-header"><strong>add Employee</strong><small> Form</small></div>
                           
                           <?php }?>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter employee name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="email" value="<?php echo $email?>" name="email" placeholder="Enter employee email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter employee mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter employee password" class="form-control" >
								</div>
								<div class="form-group">
									<label class=" form-control-label">Department</label>
									<select name="department_id"  class="form-control">
										<?php  
                              $sql=mysqli_query($con,"SELECT * FROM department");
                              while($row=mysqli_fetch_assoc($sql)){
                              if($department_id==$row['id']){
                              echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
                              }
                              else{
                              echo "<option value=".$row['id'].">".$row['department']."</option>";
                              }}
                              ?>
									</select>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter employee address" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Birthday</label>
									<input type="date" value="<?php echo $birthday?>" name="birthday"  class="form-control" required>
								</div>
							  <?php if($_SESSION['user_id']==1){?>
							   <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							  <?php }?>
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