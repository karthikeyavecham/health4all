<?php
if (isset($_POST['update'])){
 $id=$_POST['equipment_id'];
 $user_id=$_POST['user_id'];
include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $sql_equip = 	"UPDATE equipments SET equipment_type_id='$_POST[equipment_type_id]', make='$_POST[make]', model='$_POST[model]', serial_number='$_POST[serial_number]', asset_number='$_POST[asset_number]', procured_by='$_POST[procured_by]', cost='$_POST[cost]', supplier='$_POST[supplier]', supply_date='$_POST[supply_date]', warranty_period='$_POST[warranty_period]', hospital_id='$_POST[hospital_id]', department_id='$_POST[department_id]', user_id='$user_id', service_engineer='$_POST[service_engineer]', service_engineer_contact='$_POST[service_engineer_contact]', equipment_status='$_POST[equipment_status]'
				WHERE equipment_id='$id'";
 $registration = mysql_query($sql_equip);
 if($registration){
 header("location:equipment_reg_successful.php?up&&equip_id=".$id."");
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

<?php
if (isset($_POST['ok'])){
  $query= "SELECT * 
			FROM equipments 
			WHERE equipment_id='$_POST[selected_equip]'" ;

 $result = mysql_query($query);
  while ($record = mysql_fetch_array($result)){
  ?>
<div id="form_repeat" style="width:400px;">
<fieldset>
<legend><h3>Equipment Update Form</h3></legend>
<form action="equipment_update.php" method="post" name="equip_reg" onsubmit="return validate_equip();">
<div align="center">
<table width="700px">
<tr>
<td><b>Equipment ID</b></td>
<td>
<input type="hidden" value="<?php echo $_SESSION['SESS_USER_ID'];?>" name="user_id">
<input type="hidden" name="equipment_id" value="<?php echo $record['equipment_id'];?>">
<b>: <?php echo $record['equipment_id'];?></b></td>
</tr>
<tr>
<td>Equipment Type</td>
<td>
<?php
 echo": "; 
 $query_equ= "SELECT * 
		FROM equipment_type";
 $result_equ = mysql_query($query_equ);
 	echo "<select name=\"equipment_type_id\" style=\"width:155px\">";
	echo "<option value=\"\">--Select--</option>";
	while ($record_equ = mysql_fetch_array($result_equ)){
	if($record_equ['equipment_type_id']==$record['equipment_type_id']){$i="selected=\"selected\"";}else{$i="";}
	echo "<option value=\"" . $record_equ['equipment_type_id'] . "\"" .$i. ">" . $record_equ['equipment_name'] . "</option>";
	}
	echo "</select>";
?>
</td>
<td>Equipment Make</td>
<td>: <input type="text" name="make" value="<?php echo $record['make'];?>"></td>
</tr><tr>
<td>Equipment Model</td>
<td>: <input type="text" name="model" value="<?php echo $record['model'];?>"></td>
<td>Serial Number</td>
<td>: <input type="text" name="serial_number" value="<?php echo $record['serial_number'];?>"></td>
</tr><tr>
<td>Asset Number</td>
<td>: <input type="text" name="asset_number" value="<?php echo $record['asset_number'];?>"></td>
<td>Procured by</td>
<td>: 
<select name="procured_by" style="width:155px">
<option value="" <?php if($record['procured_by']=='') {echo "selected='selected'";} ?>>--Select--</option>
<option value="Hospital" <?php if($record['procured_by']=='Hospital') {echo "selected='selected'";} ?>>Hospital</option>
<option value="College" <?php if($record['procured_by']=='College') {echo "selected='selected'";} ?>>College</option>
<option value="Deparment" <?php if($record['procured_by']=='Deparment') {echo "selected='selected'";} ?>>Deparment</option>
<option value="Central Government" <?php if($record['procured_by']=='Central Government') {echo "selected='selected'";} ?>>Central Government</option>
<option value="State Government" <?php if($record['procured_by']=='State Government') {echo "selected='selected'";} ?>>State Government</option>
<option value="Donated" <?php if($record['procured_by']=='Donated') {echo "selected='selected'";} ?>>Donated</option>
</select>
</td>
</tr><tr>
<td>Equipment Cost</td>
<td>: <input type="text" name="cost" value="<?php echo $record['cost'];?>"></td>
<td>Supplier</td>
<td>: <input type="text" name="supplier" value="<?php echo $record['supplier'];?>"></td>
</tr><tr>
<td>Supply Date</td>
<td>: <input type="text" name="supply_date" id="datepicker" value="<?php echo $record['supply_date'];?>"></td>
<td>Warranty Period</td>
<td>: <input type="text" name="warranty_period" value="<?php echo $record['warranty_period'];?>"></td>
</tr><tr>
<td>Service Engineer</td>
<td>: <input type="text" name="service_engineer" value="<?php echo $record['service_engineer'];?>"></td>
<td>Service Engineer Contact</td>
<td>: <input type="text" name="service_engineer_contact" value="<?php echo $record['service_engineer_contact'];?>"></td>
</tr><tr>
<td>Hospital</td>
<td>
<?php
	echo": "; 
	$query_hosp= "	SELECT * 
					FROM hospitals";
	$result_hosp = mysql_query($query_hosp);
 	echo "<select name=\"hospital_id\" style=\"width:155px\">";
	while ($record_hosp = mysql_fetch_array($result_hosp)){
	if($record['hospital_id']==$record_hosp['hospital_id']){$i="selected=\"selected\"";}else{$i="";}
	echo "<option value=\"" . $record_hosp['hospital_id'] . "\" ".$i.">" . $record_hosp['hospital'] . "</option>";
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
	echo "<option value=\"\">--Select--</option>";
	while ($record_dept = mysql_fetch_array($result_dept)){
	if($record_dept['department_id']!="0"){
	if($record['department_id']==$record_dept['department_id']){$i="selected=\"selected\"";}else{$i="";}
    echo "<option value=\"" . $record_dept['department_id'] . "\" ".$i.">" . $record_dept['department'] . "</option>";
	 }}
	echo "</select>";
?>
</td></tr>
<tr>
<td>Equipment Status</td>
<td>: 
<select name="equipment_status" style="width:155px">
<option value="1" <?php if($record['equipment_status']=='1') {echo "selected=\"selected\"";}?>>In Use</option>
<option value="0" <?php if($record['equipment_status']=='0') {echo "selected=\"selected\"";}?>>Removed</option>
</select>
</td>
</tr>
</table>
</div>
<br>
<div align="center">
<input type="submit" name="update" value="Update" style="width:150px; height:30px">
</div>
</form>
</fieldset>
<?php }} ?>
<!-- end right div content -->
 </div>
 <?php include '../footer.php'; ?>
 <!-- end main page content -->
 </div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
