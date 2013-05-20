<?php
if (isset($_POST['submit'])){
$id=$_POST['equipment_id'];
$user_id=$_POST['user_id'];
include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $sql_service = 	"INSERT into service_records(request_id, equipment_id, user_id, call_date, call_time, call_information_type, call_information, service_provider, service_person, service_person_remarks, service_date, service_time, problem_status, working_status)
					VALUES (NULL,'$_POST[equipment_id]','$user_id','$_POST[call_date]','$_POST[call_time]','$_POST[call_information_type]','$_POST[call_information]','$_POST[service_provider]','$_POST[service_person]' ,'$_POST[service_person_remarks]','$_POST[service_date]','$_POST[service_time]','$_POST[problem_status]','$_POST[working_status]')";
 $registration1 = mysql_query($sql_service);
 $ids = mysql_insert_id();
 if($registration1){
 header("location:equip_issue_reg_successful.php?issue_id=".$ids."");
 exit();
 }}
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

<!--<div id="repeat_main">
<table>
<form name="searchform" method="post" action="equip_issue_reg.php">
<tr><td>Search by</td> 
 <td><select name="search_by">
    <option value="serial_number">Machine Serial Number</option>
	<option value="asset_number">Machine Asset Number</option>
    <option value="equipment_id">Equipment Id</option>
	</select></td>
  <td><input type="text" name="search_text"></td>
  <td><input type="submit" name="search" value="search"></td>
  </tr>
  </form>
  </table>
  </div>
    <hr>-->
	<br><br>
  
<?php
if (isset($_POST['ok'])){ ?>
<table width="950"><tr><td style="vertical-align:top;">
<?php
  $query= "SELECT * 
			FROM equipments 
			WHERE equipment_id='$_POST[selected_equip]'" ;

 $result = mysql_query($query);
  while ($record = mysql_fetch_array($result)){
  ?>
<div id="form_repeat" style="width:220px;">
<fieldset>
<legend><h3>Equipment Details</h3></legend>
<form action="equip_issue_reg.php" method="post">
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
<form action="equip_issue_reg.php" method="post" name="issue_reg" onsubmit="return validateForm();">
<input type="hidden" value="<?php echo $id;?>" name="equipment_id">
<input type="hidden" value="<?php echo $_SESSION['SESS_USER_ID'];?>" name="user_id">
<table width="100%">
<tr>
<td>Call-Date</td>
<td>: <input type="text" id="datepicker" name="call_date"></td>

<td>Call-Time</td>
<td>: <input type="text" id="vtimepicker" size="10" name="call_time"></td>
</tr><tr>
<td>Call Information Type</td>
<td>: <input type="text" name="call_information_type"></td>

<td rowspan='2' style="vertical-align:top;">Call Information</td>
<td rowspan='2' style="vertical-align:top;">: <textarea rows="3" cols="15" name="call_information"></textarea></td>
</tr>
<tr>
<td>Working Status</td>
<td>: 
<select name="working_status" style="width:155px">
<option value="1">Working</option>
<option value="0">Not Working</option>
</select>
</td>
</tr>
<tr>
<td colspan='4'><hr></td>
</tr>
<tr>
<td>Service Provider</td>
<td>: <input type="text" name="service_provider"></td>

<td>Service Person</td>
<td>: <input type="text" name="service_person"></td>
</tr><tr>
<td>Service Person Remarks</td>
<td>: <input type="text" name="service_person_remarks"></td>

<td>Service-Date</td>
<td>: <input type="text" id="vdatepicker" name="service_date"></td>
</tr><tr>
<td>Service-Time</td>
<td>: <input type="text" size="10" id="otimepicker" name="service_time"></td>

<td>Problem Status</td>
<td>: <select name="problem_status">
<option value="Issue Reported">Issue Reported</option>
<option value="Service Visit Made">Service Visit Made</option>
<option value="Under Observation">Under Observation</option>
<option value="Issue Resolved">Issue Resolved</option>
</select>
</td>
</tr>
</table>
<br>
<div align="center">
<input type="submit" name="submit" value="Submit" style="width:150px; height:30px">
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
