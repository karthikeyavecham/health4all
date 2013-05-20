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
 
 <h3>Report : In-Patients Visits Summary</h3>

<form action="report_patient_details_op.php" method="post">
<table>
<tr>
<th>From Date</th>
<th>To Date</th>
<th>Department</th>
</tr>
<tr>
<td><input type="text" name="from_date" id="vdatepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td><input type="text" name="to_date" id="datepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td>
<?php 
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $query_dept= "SELECT * 
		FROM departments";
 $result_dept = mysql_query($query_dept);
 	echo "<select name=\"department\">";
	echo "<option value=\"\">--ALL--</option>";
	while ($record_dept = mysql_fetch_array($result_dept)){
	if($record_dept['department_id']!="0"){
    echo "<option value=\"" . $record_dept['department_id'] . "\">" . $record_dept['department'] . "</option>";
	 }}
	echo "</select>";
?>
</td>
</tr>
<tr>
<td colspan="2" align="center"><input type="submit" name="submit"></td>
</tr>
</table>
</form>
<br>

<?php
if (isset($_POST['submit'])){

 //connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 if($_POST['department']!=""){
 $dept= "AND (patient_visits.department_id=\"" . $_POST['department'] . "\")";
 } 
 else $dept="";
 
 $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'";$query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'";
 $result_dept = mysql_query($query_dept);
 $record_dept = mysql_fetch_array($result_dept);
 echo "<b>Report Period : " . date("d M Y", strtotime($_POST['from_date'])) . "</b> to <b>" . date("d M Y", strtotime($_POST['to_date'])) . "</br>Department : "; if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";} echo"</b></br>"; 
 $query= "SELECT *
          FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  INNER JOIN districts ON patients.district_id = districts.district_id
		  INNER JOIN departments ON patient_visits.department_id = departments.department_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='OP') AND (visit_id=admit_id)" . $dept . ")
          ORDER BY admit_date";
 $result = mysql_query($query);
 if(mysql_num_rows($result) != 0) {
 $i=1;
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<th>S.no</th>"; echo "<th>OP Date</th>"; echo "<th>Patient ID</th>"; echo "<th>OP ID</th>"; echo "<th>Name</th>"; 
 echo "<th>Age(years)</th>"; echo "<th>Age(months)</th>"; echo "<th>Gender</th>"; echo "<th>District</th>"; echo "<th>Department</th>"; echo "<th>Chief Complaint</th>";
 echo "</thead>";
    $csv_hdr = "S.no,OP Date,Patient ID,OP ID,Name,Age(years),Age(months),Gender,District,Department,Chief Complaint";
    $csv_output="";
 echo "<tbody>";
 while ($record = mysql_fetch_array($result)){
 echo "<tr>";
 echo "<td>" . $i . "</td>";
$csv_output .= $i . ", ";
 echo "<td>" . date("d M Y", strtotime($record['admit_date'])) . "</td>";
$csv_output .= date("d M Y", strtotime($record['admit_date'])) . ", ";
 echo "<td>" . $record['patient_id'] . "</td>";
$csv_output .= $record['patient_id'] . ", ";
 echo "<td>" . $record['hosp_file_no'] . "</td>";
$csv_output .= $record['hosp_file_no'] . ", ";
 echo "<td>" . $record['name'] . "</td>";
$csv_output .= $record['name'] . ", ";
 echo "<td>" . $record['age_years'] . "</td>";
$csv_output .= $record['age_years'] . ", ";
 echo "<td>" . $record['age_months'] . "</td>";
$csv_output .= $record['age_months'] . ", ";
 echo "<td>" . $record['gender'] . "</td>";
$csv_output .= $record['gender'] . ", ";
 echo "<td>" . $record['district'] . "</td>";
$csv_output .= $record['district'] . ", ";
 echo "<td>" . $record['department'] . "</td>";
$csv_output .= $record['department'] . ", ";
 echo "<td>" . $record['presenting_complaints'] . "</td>";
$csv_output .= $record['presenting_complaints'] . "\n ";
 echo "</tr>";
 $i++;
 }
?>
<form name="export" action="export.php" method="post">
<input type="submit" value="Export table to CSV">
<input type="hidden" value="<?php echo $csv_hdr; ?>" name="csv_hdr">
<input type="hidden" value="<?php echo $csv_output; ?>" name="csv_output">
</form>
<?php
 echo "</tbody>";
 echo "</table>";
 }
  else
 {
 Echo "<br><br><b style=\"color:red;\">No data in this given dates</b>";
 } 
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
