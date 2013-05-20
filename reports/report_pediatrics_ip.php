<?php $thispage = "reports"; ?>
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
 <?php include '../menubar_reports.php' ;?>

 <!-- begin main page content -->
  <div id="content-main">
 
 <!-- begin right div content -->
 <div id="right">
 
 <h3>Report : In-Patient Details (Admissions,Discharges,Deaths)</h3>

<form action="report_pediatrics_ip.php" method="post">
<?php require_once "report_classes/table_form.php";?>
</form>
<br>

<?php
if (isset($_POST['submit'])){
 if($_POST['from_date']==$_POST['to_date']) {
 $dates=date("d M Y", strtotime($_POST['from_date']));}
 else {
 $dates=date("d M Y", strtotime($_POST['from_date'])) ." to ". date("d M Y", strtotime($_POST['to_date']));
 }
 //connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
  if($_POST['department']!=""){
 $dept= "AND (patient_visits.department_id='" . $_POST['department'] . "')";
 }
 else $dept="";
 
 if($_POST['gender']!=""){
 $gender= "AND (patients.gender='" . $_POST['gender'] . "')";
 }
 else $gender="";
 
 $unit=""; $i=0;
 foreach($_POST['unit'] as $un) {
 if($un!=""){
 if($i==0){
 $unit="(patient_visits.unit='" . $un . "')";
 }else{ 
 $unit= $unit . "OR (patient_visits.unit='" . $un . "')";
 }}
 else {$unit=""; break; }
 $i++;}
 
 if($unit!='') {
 $unit= "AND (" .$unit. ")";
 }
  
 $area=""; $i=0;
 foreach($_POST['area'] as $ar) {
 if($ar!=""){
 if($i==0){
 $area="(patient_visits.area='" . $ar . "')";
 }else{ 
 $area= $area . "OR (patient_visits.area='" . $ar . "')";
 }}
 else {$area=""; break; }
 $i++;}
 
 if($area!='') {
 $area= "AND (" .$area. ")";
 }
 

 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";} if(isset($_POST['unit'])){
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Unit</u> : </b>"; $a=0; foreach($_POST['unit'] as $un) { if($un!=""){$query_unit= "SELECT * FROM units WHERE unit_id='" . $un . "'"; $result_unit = mysql_query($query_unit); $record_unit = mysql_fetch_array($result_unit); if($a!='0'){echo ", ";} echo $record_unit['unit_name']; $a++;} else {echo "ALL"; break;}}  
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Area</u> : </b>"; $a=0; foreach($_POST['area'] as $ar) { if($ar!=""){$query_area= "SELECT * FROM areas WHERE area_id='" . $ar . "'"; $result_area = mysql_query($query_area); $record_area = mysql_fetch_array($result_area); if($a!='0'){echo ", ";} echo $record_area['area_name']; $a++;} else {echo "ALL"; break;}} } 
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Gender</u> : </b>"; if($_POST['gender']=="M"){echo "Male";} elseif($_POST['gender']=="F"){echo "Female";} else {echo "ALL";} echo"</br></br>"; 

 $query= "SELECT *
		  FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  WHERE ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')" . $dept . $unit . $area . $gender . ")";
		  
 $result = mysql_query($query);
 $i=1;
 echo "<div class=\"scrollbar\" style=\"width: 950px; height: 600px;\">";
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<tr><th colspan=10><table width=100% style=\"font-size:small\";><td width=50%>No of Admissions</td><td width=50%>Date : ".$dates. "</td></table></th></tr>";
 echo "<tr><th>S.no</th>"; echo "<th>Patient Name</th>"; echo "<th>Mother's Name</th>"; echo "<th>Address/Phone</th>"; echo "<th>Sex</th>"; echo "<th>Age at Admission (days)</th>"; echo "<th>Admit Weight (gms)</th>";echo "<th>In Born</th>";echo "<th>Out Born</th>"; echo "<th>Provisional Diagnosis</th></tr>"; 
 echo "</thead>";
 echo "<tbody>";
 if(mysql_num_rows($result) != 0) {
 while ($record = mysql_fetch_array($result)){
 if($record['dob']!=''){
 $age = abs(strtotime($record['admit_date']) - strtotime($record['dob'])) / (60 * 60 * 24);
 } else { $age=''; } 
 echo "<tr>";
 echo "<td>" . $i . "</td>";
 echo "<td>" . $record['name'] . "</td>";
 echo "<td>" . $record['mother_name'] . "</td>";
 echo "<td>" . $record['place'] ."/". $record['phone'] . "</td>";
 echo "<td>" . $record['gender'] . "</td>";
 echo "<td>" . $age . "</td>";
 echo "<td>" . $record['admit_weight'] . "</td>";
  
 if($record['delivery_location']=="hospital" AND $record['delivery_location_type']=="IN"){
 $inborn=$record['delivery_place']; } 
 else { $inborn=""; }
 echo "<td>" . $inborn . "</td>";
 
 if($record['delivery_location']=="enroute"){$outborn='Enroute';} 
 else if($record['delivery_location']=="home"){$outborn='Home'; } 
 else if($record['delivery_location']=="hospital" and $record['delivery_location_type']=="OUT"){$outborn=$record['delivery_place'];} 
 else { $outborn=""; }
 echo "<td>" . $outborn . "</td>";
 
 echo "<td>" . $record['provisional_diagnosis'] . "</td>";
 echo "</tr>";
 $i++;
 }
 } else { echo "<td colspan=10>No Admissions in this dates</td>"; }
 echo "</tbody>";

 //------------------------------------------------------------------------------------------------------------------
 
 $query_1= "SELECT *
			FROM patient_visits
			INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
			WHERE ((outcome_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP') AND ((outcome='discharge') OR (outcome='lama') OR (outcome='absconded'))" . $dept . $unit . $area . $gender . ")";
		  
 $result_1 = mysql_query($query_1);
 $i=1;
 echo "<thead>";
 echo "<tr><th colspan=10><table width=100% style=\"font-size:small\";><td width=50%>No of Discharges</td><td width=50%>Date : ".$dates. "</td></table></th></tr>";
 echo "<tr><th>S.no</th>" ;echo "<th>Patient Name</th>"; echo "<th>Mother's Name</th>"; echo "<th>Address/Phone</th>"; echo "<th>Sex</th>"; echo "<th>Age at Admission (days)</th>"; echo "<th>Discharge Weight (gms)</th>";echo "<th>In Born</th>";echo "<th>Out Born</th>"; echo "<th>Final Diagnosis</th></tr>"; 
 echo "</thead>";
 echo "<tbody>";
 if(mysql_num_rows($result_1) != 0) {
 while ($record_1 = mysql_fetch_array($result_1)){
 if($record_1['dob']!=''){
 $age = abs(strtotime($record_1['admit_date']) - strtotime($record_1['dob'])) / (60 * 60 * 24);
 } else { $age=''; }
 echo "<tr>";
 echo "<td>" . $i . "</td>";
 echo "<td>" . $record_1['name'] . "</td>";
 echo "<td>" . $record_1['mother_name'] . "</td>";
 echo "<td>" . $record_1['place'] ."/". $record_1['phone'] . "</td>";
 echo "<td>" . $record_1['gender'] . "</td>";
 echo "<td>" . $age . "</td>";
 echo "<td>" . $record_1['discharge_weight'] . "</td>";
  
 if($record_1['delivery_location']=="hospital" AND $record_1['delivery_location_type']=="IN"){
 $inborn=$record_1['delivery_place']; } 
 else { $inborn=""; }
 echo "<td>" . $inborn . "</td>";
 
 if($record_1['delivery_location']=="enroute"){$outborn='Enroute';} 
 else if($record_1['delivery_location']=="home"){$outborn='Home'; } 
 else if($record_1['delivery_location']=="hospital" and $record_1['delivery_location_type']=="OUT"){$outborn=$record_1['delivery_place'];} 
 else { $outborn=""; }
 echo "<td>" . $outborn . "</td>";
 
 echo "<td>" . $record_1['final_diagnosis'] . "</td>";
 echo "</tr>";
 $i++;
 }
 } else { echo "<td colspan=10>No Discharges in this dates</td>"; }
 echo "</tbody>";

  //------------------------------------------------------------------------------------------------------------------
 
 $query_2= "SELECT *
		  FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  WHERE ((outcome_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP') AND(outcome='death')" . $dept . $unit . $area . $gender . ")";
		  
 $result_2 = mysql_query($query_2);
 $i=1;
 echo "<thead>";
 echo "<tr><th colspan=10><table width=100%  style=\"font-size:small\";><td width=50%>No of Deaths</td><td width=50%>Date : ".$dates. "</td></table></th></tr>";
 echo "<tr><th>S.no</th>"; echo "<th>Patient Name</th>"; echo "<th>Mother's Name</th>"; echo "<th>Address/Phone</th>"; echo "<th>Sex</th>"; echo "<th>Age at Admission (days)</th>"; echo "<th>Discharge Weight (gms)</th>";echo "<th>In Born</th>";echo "<th>Out Born</th>"; echo "<th>Final Diagnosis</th></tr>"; 
 echo "</thead>";
 echo "<tbody>";
 if(mysql_num_rows($result_2) != 0) {
 while ($record_2 = mysql_fetch_array($result_2)){
 if($record_2['dob']!=''){
 $age = abs(strtotime($record_2['admit_date']) - strtotime($record_2['dob'])) / (60 * 60 * 24);
 } else { $age=''; } 
 echo "<tr>";
 echo "<tr>";
 echo "<td>" . $i . "</td>";
 echo "<td>" . $record_2['name'] . "</td>";
 echo "<td>" . $record_2['mother_name'] . "</td>";
 echo "<td>" . $record_2['place'] ."/". $record_2['phone'] . "</td>";
 echo "<td>" . $record_2['gender'] . "</td>";
 echo "<td>" . $age . "</td>";
 echo "<td>" . $record_2['discharge_weight'] . "</td>";
 
 if($record_2['delivery_location']=="hospital" AND $record_2['delivery_location_type']=="IN"){
 $inborn=$record_2['delivery_place']; } 
 else { $inborn=""; }
 echo "<td>" . $inborn . "</td>";
 
 if($record_2['delivery_location']=="enroute"){$outborn='Enroute';} 
 else if($record_2['delivery_location']=="home"){$outborn='Home'; } 
 else if($record_2['delivery_location']=="hospital" and $record_2['delivery_location_type']=="OUT"){$outborn=$record_2['delivery_place'];} 
 else { $outborn=""; }
 echo "<td>" . $outborn . "</td>";
 
 echo "<td>" . $record_2['final_diagnosis'] . "</td>";
 echo "</tr>";
 $i++;
 }
 } else { echo "<td colspan=10>No Deaths in this dates</td>"; } 
 echo "</tbody>";
 echo "</table>"; 
 echo "</div>";
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
