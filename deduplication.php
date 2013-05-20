<?php $thispage = "deduplication"; ?>
<!DOCTYPE html>
<html>
 <head>
 <!-- link to css style sheet -->
 <link rel="stylesheet" type="text/css" href="health4all.css">
 <link rel="stylesheet" href="scripts/jquery-ui.css" />
    <script src="scripts/jquery183.js"></script>
    <script src="scripts/jquery-ui.js"></script>
	<script src="scripts/registration.js"> </script>
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
<?php
	$query="SELECT *
	FROM patients
	JOIN patient_visits ON patients.patient_id = patient_visits.patient_id
	WHERE visit_type = 'IP'
	AND visit_id = admit_id
	GROUP BY patient_visits.patient_id, admit_date
	HAVING count( visit_type ) >1
	AND count( admit_date ) >1";
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");		 
	$result = mysql_query($query);
	echo"<h3>Possible duplicates :  </h3>";
	echo "<table id=\"table-search\">";
	echo "<thead>";
	// echo "<th>User ID</th>";
	// echo "<th>Username</th>";
	echo "<th>Patient ID</th>"; 
	echo "<th>Name</th>";
	echo "<th>Father Name</th>";
	echo "<th>Mother Name</th>"; 
	echo "<th>DOB</th>"; 
	echo "<th>Age</th>"; 
	echo "<td></td>";
	echo "<td></td>";
	echo "</thead>";
	echo "<tbody>";
	while ($record = mysql_fetch_array($result))
	{
		echo "<tr>";
		// echo "<td>" . $record['user_id'] . "</td>";
		// echo "<td>" . $record['username'] . "</td>";
		echo "<td><lable name=\"ptid\" value=\"" . $record['patient_id'] . "\">" . $record['patient_id'] . "</td>";
		echo "<td>" . $record['name'] . "</td>";
		echo "<td>" . $record['father_name'] . "</td>";
		echo "<td>" . $record['mother_name'] . "</td>";
		echo "<td>"; if($record['dob']!='0000-00-00') {echo date("d M Y", strtotime($record['dob']));} echo "</td>";
		echo "<td>" . $record['age_years'] . "</td>";
		echo "<td>";
		echo "<form action=deduplication.php method=post>";
		echo "<input type=\"hidden\" name=\"search_pid\" value=\"" . $record['patient_id'] . "\">";
		echo "<input type=\"hidden\" name=\"search_name\" value=\"". $record['name'] . "\">";
		echo "<input type=submit name=ok value=Go>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	 }
	echo "</tbody>";
	echo "</table>";
?>
<?php
if (isset($_POST['ok']))
{
		$query ="SELECT * 
		FROM patient_visits 
		JOIN departments 
		ON patient_visits.department_id = departments.department_id
		WHERE patient_visits.patient_id='$_POST[search_pid]' AND
		visit_type = 'IP'
		ORDER BY visit_id DESC";
		include("db_connect.php");
		mysql_connect("$dbhost","$dbuser","$dbpass");
		mysql_select_db("$dbdatabase");		 
		$result = mysql_query($query);
		echo"<h3> <center>Delete a record :  </center> </h3>";
		echo "<h4>Patient ID : " . $_POST['search_pid'] . "&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Name : " . $_POST['search_name'] . "</h4>";
		echo "<table id=\"table-his\">";
		echo "<thead>";
		echo "<th>Sno</th>"; 
		echo "<th>Date</th>"; 
		echo "<th>Type</th>"; 
		echo "<th>Visit id</th>"; 
		echo "<th>IP No</th>"; 
		echo "<th>Department</th>"; 
		echo "<th>Complaint</th>"; 
		echo "<th>Final Diagnosis</th>"; 
		echo "<th>Discharge Date</th>";
		echo "<td></td>";  
		echo "</thead>";
		echo "<tbody>";
	$sno=1;
	while ($record = mysql_fetch_array($result))
	{
		echo "<tr>"; echo "<td>";
		echo "<form action=deduplication.php method=post>";
		echo "<input type=\"hidden\" name=\"view_visit\" value=\"". $record['visit_id'] . "\">";
		echo "<input type=submit name=go style=\"width:40px;\" value=" . $sno . ">";
		echo "</form>";
		echo "</td>";
		echo "<td>"; 
		if($record['admit_date']!='0000-00-00') 
		{
			echo date("d M Y", strtotime($record['admit_date']));
		} 
		echo "</td>";
		echo "<td>" . $record['visit_type'] . "</td>";
		echo "<td>" . $record['visit_id'] . "</td>";
		echo "<td>" . $record['hosp_file_no'] . "</td>";
		echo "<td>" . $record['department'] . "</td>";
		echo "<td>" . $record['presenting_complaints'] . "</td>";
		echo "<td>" . $record['final_diagnosis'] . "</td>";
		echo "<td>"; 
		if($record['outcome_date']!='0000-00-00') 
		{
			echo date("d M Y", strtotime($record['outcome_date']));
		}
		echo "</td>";
		echo "<td><form name=delete action=delete.php method=post><input type=\"hidden\" name=\"search_pid\" value=\"" . $record['visit_id'] . "\"> <input type=submit name=del_patient value=X></form></td>";
		echo "</tr>";
		$sno++;
	}
	echo "</tbody>";
	echo "</table>";
}
?>
<?php
if (isset($_POST['go'])){
 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
$up_visit=$_POST['view_visit'];
$query_1= "SELECT * 
		FROM patient_visits
		INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		WHERE patient_visits.visit_id='" . $up_visit ."'";
 $result_1 = mysql_query($query_1);
 $record_1 = mysql_fetch_array($result_1);
 if($record_1['mlc']==1){
 $query= "SELECT * 
		FROM patient_visits
		INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		INNER JOIN mlc ON patient_visits.visit_id = mlc.visit_id
		WHERE patient_visits.visit_id='" . $up_visit ."'";
 } else {
$query= "SELECT * 
		FROM patient_visits
		INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		WHERE patient_visits.visit_id='" . $up_visit ."'";
}
 $result = mysql_query($query);
   while ($record = mysql_fetch_array($result)){

  include 'tabs/update_tabs.php' ;
  }
  }
 ?>  
<?php
if(isset($_POST['confirm2']))
{
	$query="SELECT * FROM patients JOIN patient_visits ON patients.patient_id=patient_visits.patient_id WHERE visit_id='$_POST[search_pid]'";
	$delquery="DELETE FROM patient_visits WHERE visit_id='$_POST[search_pid]'";
	$result=mysql_query($query);
	while($record = mysql_fetch_array($result)){
	echo "<h3> Deleted </h3>";
	echo "<table id=table-search>
	<tr>
	<td>Patient ID </td> 
	<td>".$record['patient_id']."</td>	
	</tr>
	<tr>
	<td>Visit ID </td> 
	<td>".$record['visit_id']."</td>	
	</tr>
	<tr>
	<td>Patient name </td> 
	<td>".$record['name']."</td>	
	</tr>
	</table>";
	}
	$resultdel=mysql_query($delquery);
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
 
