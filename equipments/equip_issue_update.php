<?php
if (isset($_POST['update'])){
$id=$_POST['equipment_id'];
$user_id=$_POST['user_id'];
$request_id=$_POST['request_id'];
include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $sql_service = 	"UPDATE service_records SET equipment_id='$id', user_id='$user_id', call_date='$_POST[call_date]', call_time='$_POST[call_time]', call_information_type='$_POST[call_information_type]', call_information='$_POST[call_information]', service_provider='$_POST[service_provider]', service_person='$_POST[service_person]', service_person_remarks='$_POST[service_person_remarks]', service_date='$_POST[service_date]', service_time='$_POST[service_time]', problem_status='$_POST[problem_status]', working_status='$_POST[working_status]'
                     WHERE request_id='".$request_id."'";
 $registration1 = mysql_query($sql_service);
 if($registration1){
 header("location:equip_issue_reg_successful.php?up&&issue_id=".$request_id."");
 exit();
 } else{echo "jinkaa:". mysql_error();}}
?>
<?php $thispage = "equipment"; ?>
<!DOCTYPE html>
 <html>

 <head>
	<script src="../scripts/jquery183.js"></script>
    <script src="../scripts/jquery-ui.js"></script>
	<script src="../scripts/jquery.ui.core.min.js"></script>
	<script src="../scripts/jquery.ui.widget.js"></script>
	<script src="../scripts/datepicker.js"></script>
	<script type="text/javascript" src="../scripts/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="../scripts/jquery.mousewheel.js"></script>
	<script src="../scripts/registration.js"></script>
	<script src="equipment.js"></script>
 <!-- link to css style sheet -->
	<link rel="stylesheet" href="../scripts/jquery-ui.css" />
 	<link rel="stylesheet" type="text/css" href="../health4all.css">
 </head>

 <body>
 <!-- begin wrap contents of page  -->
 <div id="wrapper">



 <!--menubar-->
 <?php include 'menubar_equ.php' ;?>

 <!-- begin main page content -->
 <div id="content-main">

 <!-- begin right div content -->
 <div id="right">
 <br><br>

  <?php 
if (isset($_POST['ok'])) {

//connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 $viewquery = "SELECT * 
			FROM service_records 
			WHERE equipment_id='$_POST[selected_equip]'";

 $result = mysql_query($viewquery);
 echo "<table id=\"table-search\">";
 echo "<thead>";
 echo "<th></th>";
 echo "<th>Service ID</th>"; echo "<th>Call Date</th>"; echo "<th>Call Info Type</th>"; echo "<th>Service Provider</th>"; echo "<th>Service Person</th>"; echo "<th>Service Date</th>"; echo "<th>Problem States</th>";
 echo "</thead>";
 echo "<tbody>";
 while ($record_result = mysql_fetch_array($result)){
 echo "<tr>";
 echo "<td>";
 echo "<form action=equip_issue_update.php method=post>";
 echo "<input type=\"hidden\" name=\"selected_request\" value=\"". $record_result['request_id']. "\">";
 echo "<input type=submit name=go value=Go>";
 echo "</form>";
 echo "</td>";
 echo "<td>" . $record_result['request_id'] . "</td>";
 echo "<td>"; if($record_result['call_date']!='0000-00-00') {echo date("d M Y", strtotime($record_result['call_date']));} echo "</td>";
 echo "<td>" . $record_result['call_information_type'] . "</td>";
 echo "<td>" . $record_result['service_provider'] . "</td>";
 echo "<td>" . $record_result['service_person'] . "</td>";
 echo "<td>"; if($record_result['service_date']!='0000-00-00') {echo date("d M Y", strtotime($record_result['service_date']));} echo "</td>";
 echo "<td>" . $record_result['problem_status'] . "</td>";

 echo "</tr>";
  }
 echo "</tbody>";
 echo "</table>";
 }
?>

<?php
if (isset($_POST['go'])){ ?>
<table width="950"><tr><td style="vertical-align:top;">
<?php
  $query1="SELECT equipment_id FROM service_records WHERE request_id='$_POST[selected_request]'";
  $result1 = mysql_query($query1);
  while ($record1 = mysql_fetch_array($result1)){
  $equip_id = $record1['equipment_id']; 
  }
  
  $query= "SELECT * 
			FROM equipments 
			WHERE equipment_id='$equip_id'" ;

 $result = mysql_query($query);
  while ($record = mysql_fetch_array($result)){
  ?>
<div id="form_repeat" style="width:220px;">
<fieldset>
<legend><h3>Equipment Details</h3></legend>
<form action="equip_issue_update.php" method="post">
<div align="center">
<table id="equip_issue" width="220px">
<tr>
<td style="width:110px;"><b>Equipment ID</b></td>
<td style="width:110px;"><b>: <?php echo $record['equipment_id'];?></b></td>
</tr>
<tr>
<td>Equipment Type</td>
<td>
<?php
 echo": "; 
 $query_equ= "SELECT * 
			FROM equipment_type where equipment_type_id='$record[equipment_type_id]'";
 $result_equ = mysql_query($query_equ);
 	while ($record_equ = mysql_fetch_array($result_equ)){
	echo $record_equ['equipment_name'];
	}
?>
</td></tr>
<tr>
<td>Department</td>
<td>
<?php
	echo": "; 
	$query_dept= "SELECT * 
		FROM departments where department_id='$record[department_id]'";
	$result_dept = mysql_query($query_dept);
	while ($record_dept = mysql_fetch_array($result_dept)){
    echo $record_dept['department'];
	}
?>
</td></tr>
<tr>
<td>Equipment Make</td>
<td>: <?php echo $record['make'];?></td>
</tr><tr>
<td>Equipment Model</td>
<td>: <?php echo $record['model'];?></td>
</tr><tr>
<td>Serial Number</td>
<td>: <?php echo $record['serial_number'];?></td>
</tr><tr>
<td>Asset Number</td>
<td>: <?php echo $record['asset_number'];?></td>
</tr><tr>
<td>Procured by</td>
<td>: <?php echo $record['procured_by'];?></td>
</tr><tr>
<td>Equipment Cost</td>
<td>: <?php echo $record['cost'];?></td>
</tr><tr>
<td>Supplier</td>
<td>: <?php echo $record['supplier'];?></td>
</tr><tr>
<td>Supply Date</td>
<td>: <?php echo $record['supply_date'];?></td>
</tr><tr>
<td>Warranty Period</td>
<td>: <?php echo $record['warranty_period'];?></td>
</tr><tr>
<td>Service Engineer</td>
<td>: <?php echo $record['service_engineer'];?></td>
</tr><tr>
<td>Engineer Contact</td>
<td>: <?php echo $record['service_engineer_contact'];?></td>
</tr>
</table>	
</div>

</form>
</fieldset>
</div>
<?php 
$id=$record['equipment_id'];

} ?>

</td><td style="vertical-align:top;">
<fieldset>
<legend><h3>Equipment Service Issue Registration</h3></legend>
<form action="equip_issue_update.php" method="post" name="issue_reg" onsubmit="return validateForm();">
<input type="hidden" value="<?php echo $id;?>" name="equipment_id">
<input type="hidden" value="<?php echo $_SESSION['SESS_USER_ID'];?>" name="user_id">
<table width="100%">
<?php
$query2= "SELECT * 
			FROM service_records 
			WHERE request_id='$_POST[selected_request]'" ;

 $result2 = mysql_query($query2);
 while ($record2 = mysql_fetch_array($result2)){

?>
<tr>
<td>Request ID</td>
<td><input type="hidden" value="<?php echo $record2['request_id'];?>" name="request_id">
<?php echo $record2['request_id'];?></td>
</tr><tr>
<td>Call-Date</td>
<td>: <input type="text" id="datepicker" name="call_date" value="<?php echo $record2['call_date'];?>"></td>

<td>Call-Time</td>
<td>: <input type="text" id="vtimepicker" size="10" name="call_time" value="<?php echo $record2['call_time'];?>"></td>
</tr><tr>
<td>Call Information Type</td>
<td>: <input type="text" name="call_information_type" value="<?php echo $record2['call_information_type'];?>"></td>

<td rowspan='2' style="vertical-align:top;">Call Information</td>
<td rowspan='2' style="vertical-align:top;">: <textarea rows="3" cols="15" name="call_information"><?php echo $record2['call_information'];?></textarea></td>

</tr>
<tr>
<td>Working Status</td>
<td>: 
<select name="working_status" style="width:155px">
<option value="1" <?php if($record2['working_status']=='1') { echo "selected=\"selected\""; } ?>>Working</option>
<option value="0" <?php if($record2['working_status']=='0') { echo "selected=\"selected\""; } ?>>Not Working</option>
</select>
</td>
</tr>
<tr>
<td colspan='4'><hr></td>
</tr>
<tr>
<td>Service Provider</td>
<td>: <input type="text" name="service_provider" value="<?php echo $record2['service_provider'];?>"></td>

<td>Service Person</td>
<td>: <input type="text" name="service_person" value="<?php echo $record2['service_person'];?>"></td>
</tr><tr>
<td>Service Person Remarks</td>
<td>: <input type="text" name="service_person_remarks" value="<?php echo $record2['service_person_remarks'];?>"></td>

<td>Service-Date</td>
<td>: <input type="text" id="vdatepicker" name="service_date" value="<?php echo $record2['service_date'];?>"></td>
</tr><tr>
<td>Service-Time</td>
<td>: <input type="text" id="otimepicker" name="service_time" value="<?php echo $record2['service_time'];?>"></td>

<td>Problem Status</td>
<td>: <select name="problem_status">
<option value="Issue Reported" <?php if($record2['problem_status']=='Issue Reported') { echo "selected=\"selected\""; } ?>>Issue Reported</option>
<option value="Service Visit Made" <?php if($record2['problem_status']=='Service Visit Made') { echo "selected=\"selected\""; } ?>>Service Visit Made</option>
<option value="Under Observation" <?php if($record2['problem_status']=='Under Observation') { echo "selected=\"selected\""; } ?>>Under Observation</option>
<option value="Issue Resolved" <?php if($record2['problem_status']=='Issue Resolved') { echo "selected=\"selected\""; } ?>>Issue Resolved</option>
</select>
</td>
</tr>
<?php } ?>
</table>
<br>
<div align="center">
<input type="submit" name="update" value="Update" style="width:150px; height:30px">
</div>
</form>
</fieldset>


</td></tr></table>
<?php } ?>
<!-- end right div content -->
 </div>
 <?php include '../footer.php'; ?>
 <!-- end main page content -->
 </div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
