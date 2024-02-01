<?php 
require 'top.inc.php';
if(!isset($_SESSION['role'])){
   header('location:login.php');
   die();
}

if ($_SESSION['role'] != 1) {
   header('location: add_employee.php?id='. $_SESSION['user_id']);
   die();
}


$msg='';
$department=$id ='';
if(isset($_GET['id'])){
   $id =$_GET['id'];
   $sql= mysqli_query($con,"SELECT * FROM department order by id desc");
   $row=mysqli_fetch_assoc($sql);
   $department =$row['department'];
   }

if(isset($_POST['department'])){
    $department = mysqli_real_escape_string($con,$_POST['department']);
   if($id > 0){
       $sql= "UPDATE department SET department='$department' WHERE id='$id'";
   }else{
      $sql="INSERT INTO department(department) VALUES('$department')";
    }
    $res= mysqli_query($con,$sql);
    header('location:index.php');
   }
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Department</strong><small> Form</small></div>
                        <div class="card-body card-block">
                        <form method="post">
							   <div class="form-group">
								<label for="department" class=" form-control-label">Department Name</label>
								<input type="text" value="<?php echo $department?>" name="department" placeholder="Enter your department name" class="form-control" required></div>
							   
							   <button  type="submit" class="btn btn-lg btn-info btn-block">
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