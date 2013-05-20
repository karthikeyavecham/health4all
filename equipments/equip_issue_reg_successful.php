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
		echo "<h3>Service Update Succesful!</h3>"; }
	else {
		echo "<h3>Service Registration Successful!</h3>"; }
	
	
 if(isset($_GET['issue_id'])){
 $id=$_GET['issue_id'];
 $query= "SELECT * 
		FROM service_records where request_id='$id'";
 $result = mysql_query($query);
 	while ($record = mysql_fetch_array($result)){
?>
	
<table width="700px">
<tr>
<td width="160px"><b>Request ID</b></td>
<td width="190px"><b>: <?php echo $record['request_id'];?></b></td>
<td width="160px"><b>Equipment ID</b></td>
<td><b>: <?php echo $record['equipment_id'];?></b></td>
</tr>
<tr>
<td>Call-Date</td>
<td>: <?php echo $record['call_date'];?></td>
<td>Call-Time</td>
<td>: <?php echo $record['call_time'];?></td>
</tr><tr>
<td>Call Information Type</td>
<td>: <?php echo $record['call_information_type'];?></td>
<td rowspan='2' style="vertical-align:top;">Call Information</td>
<td rowspan='2' style="vertical-align:top;">: <textarea rows="2" cols="15" readonly><?php echo $record['call_information'];?></textarea></td>
</tr>
<tr>
<td>Working Status</td>
<td>: 
<?php if($record['working_status']=='1') { echo "Working"; } else { echo "Not Working"; } ?>
</td>
</tr>
<tr>
<td colspan='4'><hr></td>
</tr>
<tr>
<td>Service Provider</td>
<td>: <?php echo $record['service_provider'];?></td>
<td>Service Person</td>
<td>: <?php echo $record['service_person'];?></td>
</tr><tr>
<td>Service Person Remarks</td>
<td>: <?php echo $record['service_person_remarks'];?></td>
<td>Service-Date</td>
<td>: <?php echo $record['service_date'];?></td>
</tr><tr>
<td>Service-Time</td>
<td>: <?php echo $record['service_time'];?></td>
<td>Problem Status</td>
<td>: <?php echo $record['problem_status'];?></td>
</tr>


</table>	
<br>
  <table width="700px">
  <tr><td align="center">
	<?php
	echo "<form action=equip_issue_update.php method=post>";
	echo "<input type=\"hidden\" name=\"selected_request\" value=\"".$record['request_id']."\">";
	echo "<input type=\"submit\" name=\"go\"  style=\"width:200px; height:30px;\" value=\"Update This Service Details\" >";
	echo "</form>";
	?> 
  </td>
  <td align="center">
  <input type="button" onclick="window.location = 'report_detail_equip.php';" value="Update/Register Another Service Issue" style="width:250px; height:30px;">
  </td>
  </tr>
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
