<?php
require 'top.inc.php';


if (isset($_GET['type']) and $_GET['type'] == 'Delete' and $_GET['id']) {
   $id = $_GET['id'];
   $sql = mysqli_query($con, "DELETE FROM `leave` WHERE id='$id'");
}
if (isset($_GET['type']) and $_GET['type'] == 'update' and $_GET['id']) {
   $id = $_GET['id'];
   $status = $_GET['status'];
   $sql = mysqli_query($con, "UPDATE `leave`SET leave_status='$status' WHERE id='$id'");
}
if ($_SESSION['role'] == 1) {
   $sql="SELECT `leave`.* ,employee.name from `leave`,employee WHERE  `leave`.employee_id=employee.id order by id desc";}
else{
   $eid=$_SESSION['user_id'];
   $sql="SELECT * FROM `leave` WHERE employee_id='$eid' order by id desc";
}
$res = mysqli_query($con,$sql);
?>
<div class="content pb-0">
   <div class="orders">
      <div class="row">
         <div class="col-xl-12">
            <div class="card">
               <div class="card-body">
                  <h4 class="box-title">Leave </h4>
                  <?php if ($_SESSION['role'] == 2) { ?>
                     <h4 class="box_title_link"><a href="add_leave.php">Add Leave</a> </h4>
                  <?php } ?>
               </div>
               <div class="card-body--">
                  <div class="table-stats order-table ov-h">
                     <table class="table ">
                        <thead>
                           <tr>
                              <th width="5%">S.No</th>
                              <th width="5%">ID</th>
                              <th width="15%">Employee Name</th>
                              <th width="14%">From</th>
                              <th width="14%">To</th>
                              <th width="15%">Description</th>
                              <th width="8%">Leave Status</th>
                              <th width="8%"></th>
                              <th width="16%"></th>
                           </tr>
                        </thead>
                        <tbody>

                           <?php
                           $i = 1;
                           while ($row = mysqli_fetch_assoc($res)){ ?>
                              <tr>
                                 <td>
                                    <?php echo $i ?>
                                 </td>
                                 <td>
                                    <?php echo $row['id'] ?>
                                 </td>
                                 <td>
                                    <?php if($_SESSION['role']==1){ ?>
                                    <?php echo $row['name'] ?>
                                    <?php }else{?>
                                    <?php echo $_SESSION['name'] ?>
                                       <?php }?>
                                 </td>
                                 <td>
                                    <?php echo $row['leave_from'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['leave_to'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['leave_desc'] ?>
                                 </td>
                                 <td>
                                    <?php
                                    if ($row['leave_status'] == 1) {
                                       echo '<span class="text-warning">applied</span>';
                                    }
                                    if ($row['leave_status'] == 2) {
                                       echo '<span class="text-success">Approved</span>';
                                    }
                                    if ($row['leave_status'] == 3) {
                                       echo '<span class="text-danger">Rejected</span>';
                                    }
                                    ?>
                                 </td>
                                 <td>
                                       <?php if ($row['leave_status'] == 1) { ?>
                                           <a href="leave.php?id=<?php echo $row['id'] ?>&type=Delete">Delete</a>
                                             <?php }else{
                                                ?>
                                               <span class="text-danger">Unable to Delete</span>
                                            <?php }?>
                                 </td>

                                 <td>
                                    <div class="form-group">
                                       <?php if ($_SESSION['role'] == 1) { ?>
                                          <select class="form-control" onchange="leave_update_status('<?php echo $row['id'] ?>',this.options[this.selectedIndex].value)">
                                          <option value ="">Update Status</option>
                                          <option value ="2">Approved </option>
                                          <option value ="3"> Rejected</option>
                                          </select>
                                       </div>
                                    <?php } ?>
                                 </td>
                              </tr>

                              <?php $i++;
                           } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
function leave_update_status(id,select_value){
  window.location.href='leave.php?id='+id+'&type=update&status='+select_value;
}
</script>