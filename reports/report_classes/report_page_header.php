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
 

<?php
echo "<h3>Report : ".$report_title."</h3>";

echo "<form action=\"" . $action_page . "\" method=\"post\">"; 
require_once "report_classes/table_form.php";
echo "</form>";


 if (isset($_POST['submit'])){
 echo "<hr>";
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

 echo "<b><u>Report</u> : </b>" . $report_title . "</br>";
 echo "<b><u>Report Period</u> : </b>" . date("jS M Y", strtotime($_POST['from_date'])) . " to " . date("jS M Y", strtotime($_POST['to_date'])) . "</br>";
 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";} if(isset($_POST['unit'])){
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Unit</u> : </b>"; $a=0; foreach($_POST['unit'] as $un) { if($un!=""){$query_unit= "SELECT * FROM units WHERE unit_id='" . $un . "'"; $result_unit = mysql_query($query_unit); $record_unit = mysql_fetch_array($result_unit); if($a!='0'){echo ", ";} echo $record_unit['unit_name']; $a++;} else {echo "ALL"; break;}}  
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Area</u> : </b>"; $a=0; foreach($_POST['area'] as $ar) { if($ar!=""){$query_area= "SELECT * FROM areas WHERE area_id='" . $ar . "'"; $result_area = mysql_query($query_area); $record_area = mysql_fetch_array($result_area); if($a!='0'){echo ", ";} echo $record_area['area_name']; $a++;} else {echo "ALL"; break;}} } 
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Gender</u> : </b>"; if($_POST['gender']=="M"){echo "Male";} elseif($_POST['gender']=="F"){echo "Female";} else {echo "ALL";} echo"</br>"; 
 }
 ?>
