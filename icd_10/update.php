<?php $thispage = "update"; ?>
<!DOCTYPE html>
 <html>

 <head>
	<link rel="stylesheet" href="../scripts/jquery-ui.css" />
 	<link rel="stylesheet" type="text/css" href="../health4all.css">
 </head>

 <body>
 <!-- begin wrap contents of page  -->
 <div id="wrapper">



 <!--menubar-->
 <?php include 'menubar_icd.php' ;?>

 <!-- begin main page content -->
 <div id="content-main">

 <!-- begin right div content -->
 <div id="right"> 
<?php
if(isset($_POST['id'])){
include("../db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$count = count($_POST['id']);
// echo $count; echo"<br>";
echo "<h3>Successfully Updated</h3>";
?>
<div class="scrollbar" style="width: 540px; height: 380px;">
<table id="table-search" width="100%">
<thead>
<th>S.no</th>
<th>Pid</th>
<th>Name</th>
<th>Final Diagnosis</th>
<th>Icd</th>
<th>Ext</th>
</thead><tbody>
<?php
$i = 0; $j=0;
while ($i < $count) {
$icd_10=$_POST['icd_10'][$i];
$icd_10_ext=$_POST['icd_10_ext'][$i];
$visit_id=$_POST['id'][$i];
if($icd_10!=''){
$query = "UPDATE patient_visits SET icd_10='$icd_10', icd_10_ext='$icd_10_ext' WHERE visit_id='$visit_id'";
mysql_query($query) or die ("Error in query: ".mysql_error());
$j++;
$viewquery = "	SELECT patient_visits.patient_id \"pid\", icd_10, icd_10_ext, name, final_diagnosis
				FROM patient_visits 
				JOIN patients 
				ON patient_visits.patient_id = patients.patient_id
				WHERE visit_id='$visit_id' ";
			
 $result = mysql_query($viewquery);
while($rows=mysql_fetch_array($result)){
echo "<tr>";
echo "<td>".$j."</td>";
echo "<td align=\"center\">";
echo $rows['pid'];
echo "</td>";
echo "<td>";
echo $rows['name'];
echo "</td>";
echo "<td>";
echo $rows['final_diagnosis'];
echo "</td>";
echo "<td align=\"center\">";
echo $rows['icd_10'];
echo "</td>";
echo "<td align=\"center\">";
echo $rows['icd_10_ext'];
echo "</td>";
echo "</tr>";
}
}
++$i;
}
echo "<h4>".$j." - ICD_10 Codes Updated!</h4>";
?>
</tbody>
</table></div>
<br>
<input type="button" value="Update More Codes" onclick="window.location = 'icd_update.php';">
<?php
}
else{
header("location: icd_update.php");
exit();
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