<?php
if (isset($_POST['submit'])){
include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $sql_equip = "INSERT INTO equipments(equipment_id, equipment_type_id, make, model, serial_number, asset_number, procured_by, cost, supplier, supply_date, warranty_period, service_engineer, service_engineer_contact, hospital_id, department_id, user_id, equipment_status)

         VALUES (NULL, '$_POST[equipment_type_id]', '$_POST[make]', '$_POST[model]', '$_POST[serial_number]', '$_POST[asset_number]', '$_POST[procured_by]', '$_POST[cost]', '$_POST[supplier]', '$_POST[supply_date]', '$_POST[warranty_period]', '$_POST[service_engineer]', '$_POST[service_engineer_contact]', '$_POST[hospital_id]', '$_POST[department_id]' , '$_POST[user_id]', '$_POST[equipment_status]')";

 $registration = mysql_query($sql_equip);
 $id = mysql_insert_id();
 if($registration){
 header("location:equipment_reg_successful.php?equip_id=".$id."");
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
	<fieldset>
<legend><h3>Equipment Registration</h3></legend>
<form action="equipment_reg.php" method="post" name="equip_reg" onsubmit="return validate_equip();">
<input type="hidden" value="<?php echo $_SESSION['SESS_USER_ID'];?>" name="user_id">
<div align="center">
<table width="700px">
<tr>
<td>Equipment Type</td>
<td>
<?php
 echo": "; 
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $query_equ= "SELECT * 
		FROM equipment_type";
 $result_equ = mysql_query($query_equ);
 	echo "<select name=\"equipment_type_id\" style=\"width:155px\">";
	echo "<option value=\"\" selected=\"selected\">--Select--</option>";
	while ($record_equ = mysql_fetch_array($result_equ)){
	echo "<option value=\"" . $record_equ['equipment_type_id'] . "\">" . $record_equ['equipment_name'] . "</option>";
	}
	echo "</select>";
?>
</td>
<td>Equipment Make</td>
<td>: <input type="text" name="make"></td>
</tr><tr>
<td>Equipment Model</td>
<td>: <input type="text" name="model"></td>
<td>Serial Number</td>
<td>: <input type="text" name="serial_number"></td>
</tr><tr>
<td>Asset Number</td>
<td>: <input type="text" name="asset_number"></td>
<td>Procured by</td>
<td>: 
<select name="procured_by" style="width:155px">
<option value="">--Select--</option>
<option value="Hospital">Hospital</option>
<option value="College">College</option>
<option value="Deparment">Deparment</option>
<option value="Central Government">Central Government</option>
<option value="State Government">State Government</option>
<option value="Donated">Donated</option>
</select>
</td>
</tr><tr>
<td>Equipment Cost</td>
<td>: <input type="text" name="cost"></td>
<td>Supplier</td>
<td>: <input type="text" name="supplier"></td>
</tr><tr>
<td>Supply Date</td>
<td>: <input type="text" id="datepicker" name="supply_date"></td>
<td>Warranty Period</td>
<td>: <input type="text" name="warranty_period"></td>
</tr><tr>
<td>Service Engineer</td>
<td>: <input type="text" name="service_engineer"></td>
<td>Service Engineer Contact</td>
<td>: <input type="text" name="service_engineer_contact"></td>
</tr><tr>
<td>Hospital</td>
<td>
<?php
	echo": "; 
	$query_hosp= "	SELECT * 
					FROM hospitals";
	$result_hosp = mysql_query($query_hosp);
 	echo "<select name=\"hospital_id\" style=\"width:155px\">";
	// echo "<option value=\"\" selected=\"selected\">--Select--</option>";
	while ($record_hosp = mysql_fetch_array($result_hosp)){
	echo "<option value=\"" . $record_hosp['hospital_id'] . "\">" . $record_hosp['hospital'] . "</option>";
	}
	echo "</select>";
	?>
</td>
<td>Department</td>
<td>
<?php
	echo": "; 
	$query_dept= "SELECT * 
		FROM departments";
	$result_dept = mysql_query($query_dept);
 	echo "<select name=\"department_id\" style=\"width:155px\">";
	echo "<option value=\"\" selected=\"selected\">--Select--</option>";
	while ($record_dept = mysql_fetch_array($result_dept)){
	if($record_dept['department_id']!="0"){
    echo "<option value=\"" . $record_dept['department_id'] . "\">" . $record_dept['department'] . "</option>";
	 }}
	echo "</select>";
?>
</td></tr>
<tr>
<td>Equipment Status</td>
<td>: 
<select name="equipment_status" style="width:155px">
<option value="1">In Use</option>
<option value="0">Removed</option>
</select>
</td>
</tr>
</table>
</div>
<br>
<div align="center">
<input type="submit" name="submit" value="Submit" style="width:150px; height:30px">
</div>
</form>
</fieldset>
<!-- end right div content -->
 </div>
 <?php include '../footer.php'; ?>
 <!-- end main page content -->
 </div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
