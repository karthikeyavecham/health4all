<!DOCTYPE html>
<?php $thispage="delete";?>
<html>
<head>
<!-- link to css style sheet -->
<link rel="stylesheet" type="text/css" href="health4all.css">
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
<?php
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");	
if(isset($_POST['delete_patient']))
{
	$query="SELECT * FROM patients JOIN patient_visits ON patients.patient_id=patient_visits.patient_id WHERE visit_id='$_POST[search_pid]'";
	$result=mysql_query($query);
	echo '<h2>Are you sure you want to delete? </h2>';
	while($record = mysql_fetch_array($result)){
	echo "<form name=confirm method=post action=admin_panel.php><table id=table-search>
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
	<tr><td colspan=2><input type=submit name=confirm value=Delete /><input type=\"hidden\" name=\"search_pid\" value=\"" . $record['visit_id'] . "\">
	</table></form>";
	}
} 
?>
<?php
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");	
if(isset($_POST['del_patient']))
{
	$query="SELECT * FROM patients JOIN patient_visits ON patients.patient_id=patient_visits.patient_id WHERE visit_id='$_POST[search_pid]'";
	$result=mysql_query($query);
	echo '<h2>Are you sure you want to delete? </h2>';
	while($record = mysql_fetch_array($result)){
	echo "<form name=confirm method=post action=deduplication.php><table id=table-search>
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
	<tr><td colspan=2><input type=submit name=confirm2 value=Delete /><input type=\"hidden\" name=\"search_pid\" value=\"" . $record['visit_id'] . "\">
	</table></form>";
	}
} 
?>
</table>
</div></div>
</div>
</body>
</html>

