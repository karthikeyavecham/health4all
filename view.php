<?php $thispage = "view"; ?>
<!DOCTYPE html>
<html>

<head>
 	<!-- link to css style sheet -->
 	<link rel="stylesheet" type="text/css" href="health4all.css">
 	<link rel="stylesheet" href="scripts/jquery-ui.css" />
	<script src="scripts/jquery183.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/registration.js"></script>
</head>

<body>
<!-- begin wrap contents of page  -->
 <div id="wrapper">



 <!--menubar-->
 <?php include 'menubar.php' ;?>

 <!-- begin main page content -->
 <div id="content-main">

 <!-- begin right div content -->
 <div id="right"> 
 <table style="margin-top:3%;">
<form name="myform" method="post" action="view.php">
<tr>
	<td>Search by</td> 
	<td><select name="search_by" value="$_POST['search_by']">
		<option value="patient_id">Patient Id</option>
		<option value="name">Patient's Name</option>
		<option value="mother_name">Mother's Name</option>
		<option value="father_name">Father's Name</option>
		<option value="visit_id">Visit Id</option>
		<option value="hosp_file_no">IP no</option>
		<option value="phone">Phone</option>
		<option value="dob">Date Of Birth</option></select></td>
	<td><input type="text" name="search_text"></td>
	<td><input type="submit" name="search" value="Search" ></td>
</tr>
</form>
</table>
  
<hr>
  
<?php 
if (isset($_POST['search'])) 
{

	//connect to database
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");

	if(($_POST['search_by']=="visit_id") || ($_POST['search_by']=="hosp_file_no"))
	{
		$viewquery = "SELECT * 
			FROM patient_visits 
			JOIN patients 
			ON patient_visits.patient_id = patients.patient_id
			WHERE $_POST[search_by]='$_POST[search_text]'";
	}
	else if(($_POST['search_by']=="name")||($_POST['search_by']=="mother_name") ||($_POST['search_by']=="father_name")) 
	{			
		$viewquery = "SELECT * 
			FROM patients 
			WHERE ($_POST[search_by] LIKE '%$_POST[search_text]%')";
	}
	else 
	{			
		$viewquery = "SELECT * 
			FROM patients 
			WHERE ($_POST[search_by]='$_POST[search_text]')";
	}
	$result = mysql_query($viewquery);
	echo"<h3> <center>Select a Patient </center> </h3>";
	echo "<table id=\"table-search\">";
	echo "<thead>";
	echo "<th></th>";
	echo "<th>Patient ID</th>"; 
	echo "<th>Name</th>";
	echo "<th>Father Name</th>";
	echo "<th>Mother Name</th>"; 
	echo "<th>DOB</th>"; 
	echo "<th>Age</th>"; 
	echo "<th>Gender</th>"; 
	echo "<th>Place</th>"; 
	echo "</thead>";
	echo "<tbody>";
	while ($record = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>";
		echo "<form action=view.php method=post>";
		echo "<input type=\"hidden\" name=\"search_text\" value=\"" . $_POST['search_text'] . "\">";
		echo "<input type=\"hidden\" name=\"search_by\" value=\"" . $_POST['search_by'] . "\">";
		echo "<input type=\"hidden\" name=\"search_pid\" value=\"" . $record['patient_id'] . "\">";
		echo "<input type=\"hidden\" name=\"search_name\" value=\"". $record['name'] . "\">";
		echo "<input type=submit name=ok value=Go>";
		echo "</form>";
		echo "</td>";
		echo "<td><lable name=\"ptid\" value=\"" . $record['patient_id'] . "\">" . $record['patient_id'] . "</td>";
		echo "<td>" . $record['name'] . "</td>";
		echo "<td>" . $record['father_name'] . "</td>";
		echo "<td>" . $record['mother_name'] . "</td>";
		echo "<td>"; if($record['dob']!='0000-00-00') {echo date("d M Y", strtotime($record['dob']));} echo "</td>";
		echo "<td>" . $record['age_years'] . "</td>";
		echo "<td>" . $record['gender'] . "</td>";
		echo "<td>" . $record['place'] . "</td>";
		echo "</tr>";
	 }
	echo "</tbody>";
	echo "</table>";
}
?>
<?php
if (isset($_POST['ok']))
{
	//connect to database
	if(($_POST['search_by']=="visit_id") || ($_POST['search_by']=="hosp_file_no"))
	{
		$query="SELECT * 
		FROM patient_visits
        	JOIN departments 
		ON patient_visits.department_id = departments.department_id		
		WHERE $_POST[search_by] = '$_POST[search_text]'
		UNION
		SELECT * 
		FROM patient_visits
		JOIN departments 
		ON patient_visits.department_id = departments.department_id
		WHERE patient_id='$_POST[search_pid]'";
	}
	else
	{
		$query ="SELECT * 
		FROM patient_visits 
		JOIN departments 
		ON patient_visits.department_id = departments.department_id
		WHERE patient_visits.patient_id='$_POST[search_pid]'
		ORDER BY visit_id DESC";
	}
	//connect to database

	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");		 
	$result = mysql_query($query);
	echo"<h3> <center>Select the Record to be Viewed </center> </h3>";
	echo "<h4>Patient ID : " . $_POST['search_pid'] . "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Name : " . $_POST['search_name'] . "</h4>";
	echo "<table id=\"table-his\">";
	echo "<thead>";
	echo "<th>Sno</th>"; echo "<th>Date</th>"; echo "<th>Type</th>"; echo "<th>Visit id</th>"; echo "<th>IP No</th>"; echo "<th>Department</th>"; echo "<th>Complaint</th>"; echo "<th>Final Diagnosis</th>"; echo "<th>Discharge Date</th>";  
	echo "</thead>";
	echo "<tbody>";
	$sno=1;
	while ($record = mysql_fetch_array($result))
	{
		echo "<tr>"; echo "<td>";
		echo "<form action=view.php method=post>";
		echo "<input type=\"hidden\" name=\"view_visit\" value=\"". $record['visit_id'] . "\">";
		echo "<input type=submit name=go style=\"width:40px;\" value=" . $sno . ">";
		echo "</form>";
		echo "</td>";
		echo "<td>"; if($record['admit_date']!='0000-00-00') {echo date("d M Y", strtotime($record['admit_date']));} echo "</td>";
		echo "<td>" . $record['visit_type'] . "</td>";
		echo "<td>" . $record['visit_id'] . "</td>";
		echo "<td>" . $record['hosp_file_no'] . "</td>";
		echo "<td>" . $record['department'] . "</td>";
		echo "<td>" . $record['presenting_complaints'] . "</td>";
		echo "<td>" . $record['final_diagnosis'] . "</td>";
		echo "<td>"; if($record['outcome_date']!='0000-00-00') {echo date("d M Y", strtotime($record['outcome_date']));}echo "</td>";
		echo "</tr>";
		$sno++;
	}
	echo "</tbody>";
	echo "</table>";
}
?>
<?php
if (isset($_POST['go']))
{
	//connect to database
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");
	$view_visit=$_POST['view_visit'];
	$query= "SELECT * 
		FROM patient_visits
		INNER JOIN patients	ON patient_visits.patient_id = patients.patient_id
		INNER JOIN departments ON patient_visits.department_id = departments.department_id
		INNER JOIN districts ON patients.district_id = districts.district_id
		WHERE patient_visits.visit_id='" . $view_visit ."'";

	$result = mysql_query($query);
	while ($record = mysql_fetch_array($result))
	{
		include 'tabs/view_tabs.php' ;
	}
}
?> 
<!-- end right div content -->
</div>
<?php include 'footer.php'; ?>
<!-- end main page content -->
</div>
<!-- end wrap contents of page  -->
</div>
</body>
</html>
