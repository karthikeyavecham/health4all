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
	if(isset($_GET['up'])){
		echo "<h3>Equipment Update Succesful!</h3>"; }
	else {
		echo "<h3>Equipment Registration Successful!</h3>"; }
	
	
 if(isset($_GET['equip_id'])){
 $id=$_GET['equip_id'];
 $query= "SELECT * 
		FROM equipments where equipment_id='$id'";
 $result = mysql_query($query);
 	while ($record = mysql_fetch_array($result)){
?>
	
<table width="700px">
<tr>
<td><b>Equipment ID</b></td>
<td><b>: <?php echo $record['equipment_id'];?></b></td>
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
</td>
<td>Equipment Make</td>
<td>: <?php echo $record['make'];?></td>
</tr><tr>
<td>Equipment Model</td>
<td>: <?php echo $record['model'];?></td>
<td>Serial Number</td>
<td>: <?php echo $record['serial_number'];?></td>
</tr><tr>
<td>Asset Number</td>
<td>: <?php echo $record['asset_number'];?></td>
<td>Procured by</td>
<td>: <?php echo $record['procured_by'];?></td>
</tr><tr>
<td>Equipment Cost</td>
<td>: <?php echo $record['cost'];?></td>
<td>Supplier</td>
<td>: <?php echo $record['supplier'];?></td>
</tr><tr>
<td>Supply Date</td>
<td>: <?php echo $record['supply_date'];?></td>
<td>Warranty Period</td>
<td>: <?php echo $record['warranty_period'];?></td>
</tr><tr>
<td>Service Engineer</td>
<td>: <?php echo $record['service_engineer'];?></td>
<td>Service Engineer Contact</td>
<td>: <?php echo $record['service_engineer_contact'];?></td>
</tr><tr>
<td>Hospital</td>
<td>
<?php
	echo": "; 
	$query_hosp= "	SELECT * 
					FROM hospitals where hospital_id='$record[hospital_id]'";
	$result_hosp = mysql_query($query_hosp);
 	while ($record_hosp = mysql_fetch_array($result_hosp)){
	echo $record_hosp['hospital'];
	}
?>
</td>
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
<td>Equipment Status</td>
<td>: 
<?php if($record['equipment_status']=='1') { echo "In Hospital"; } else { echo "Removed"; }?>
</td>
</tr>
</table>	
<br>
	

  <table width="700px"><tr><td align="center">
 <?php
 echo "<form action=equipment_update.php method=post>";
 echo "<input type=\"hidden\" name=\"selected_equip\" value=\"". $record['equipment_id']."\">";
 echo "<input type=\"submit\" name=\"ok\"  style=\"width:200px; height:30px;\" value=\"Update This Equipment Details\" >";
 echo "</form>";
 ?> 
  </td><td align="center">
  <input type="button" onclick="window.location = 'report_detail_equip.php';" value="Register/Update Another Equipment" style="width:250px; height:30px;">
  </td></tr>
  </table>
  <?php
  }}
  else {
  echo "<h3>Error in Registration</h3>";
  }

?>
 
<!-- end right div content -->
 </div>
 <?php include '../footer.php'; ?>
 <!-- end main page content -->
 </div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
