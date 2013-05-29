<?php $thispage = "outpatient_repeat"; ?>
<!DOCTYPE html>
<html>

<head>

<script src="scripts/jquery183.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/jquery.ui.core.min.js"></script>
<script src="scripts/jquery.ui.widget.js"></script>
<script src="scripts/datepicker.js"></script>
<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="scripts/jquery.mousewheel.js"></script>
<script src="scripts/registration.js"></script>
<!-- link to css style sheet -->
<link rel="stylesheet" href="scripts/jquery-ui.css" />
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
<h3><u>Out Patient Repeat Visit</u></h3>
<div id="repeat_main">
<table>
<form name="searchform" method="post" action="registration_op_repeat.php">
<tr><td>Search by</td> 
<td><select name="search_by">
<option value="patient_id">Patient Id</option>
<option value="name">Patient's Name</option>
<option value="mother_name">Mother's Name</option>
<option value="father_name">Father's Name</option>
<option value="visit_id">Visit Id</option>
<option value="hosp_file_no">IP no</option>
<option value="phone">Phone</option>
<option value="dob">Date Of Birth</option>
</select></td>
<td><input type="text" name="search_text"></td>
<td><input type="submit" name="search" value="search"></td>
</tr>
</form>
</table>
<hr>
</div>

<?php 
if (isset($_POST['search'])) {

//connect to database
include("db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

if(($_POST['search_by']=="patient_id") || ($_POST['search_by']=="name")||($_POST['search_by']=="mother_name")||($_POST['search_by']=="father_name") || ($_POST['search_by']=="phone") || ($_POST['search_by']=="dob"))
{
$viewquery = "SELECT * 
		FROM patients 
		WHERE ($_POST[search_by] LIKE '%$_POST[search_text]%')";
}
else {			
$viewquery = "SELECT * 
		FROM patient_visits 
		JOIN patients 
		ON patient_visits.patient_id = patients.patient_id
		WHERE $_POST[search_by] LIKE '%$_POST[search_text]%'";
}
$result = mysql_query($viewquery);
echo "<table id=\"table-search\">";
echo "<thead>";
echo "<th></th>";
echo "<th>Patient ID</th>"; echo "<th>Name</th>"; echo "<th>Father Name</th>"; echo "<th>Mother Name</th>"; echo "<th>DOB</th>"; echo "<th>Age</th>"; echo "<th>Gender</th>"; echo "<th>Place</th>"; 
echo "</thead>";
echo "<tbody>";
while ($record = mysql_fetch_array($result)){
echo "<tr>";
echo "<td>";
echo "<form action=registration_op_repeat.php method=post>";
echo "<input type=\"hidden\" name=\"search_radio\" value=\"". $record['patient_id']. "\">";
echo "<input type=submit name=ok value=Go>";
echo "</form>";
echo "</td>";
echo "<td>" . $record['patient_id'] . "</td>";
echo "<td>" . $record['name'] . "</td>";
echo "<td>" . $record['father_name'] . "</td>";
echo "<td>" . $record['mother_name'] . "</td>";
echo "<td>"; if($record['dob']!='0000-00-00') {echo date("d M Y", strtotime($record['dob']));} echo "</td>";
echo "<td>" . $record['age_months'] . "</td>";
echo "<td>" . $record['gender'] . "</td>";
echo "<td>" . $record['place'] . "</td>";
echo "</tr>";
}
echo "</tbody>";
echo "</table>";
}
?>
<?php
if (isset($_POST['ok'])){
//connect to database
include("db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");

$query= "SELECT * 
		FROM patients 
		WHERE patient_id='$_POST[search_radio]'" ;

$result = mysql_query($query);
while ($record = mysql_fetch_array($result)){
?>
<form name="opreg" action="registration_op_exec.php" onsubmit="return validateForm_opreg();" method="post">
<table>
<tr><td>
<div id="form_repeat">
<fieldset>
<legend><h3>Out-Patient Registration</h3></legend>

<?php echo "<input type=\"hidden\" name=\"patient_id\" style=\"width:80px;\" value=\"" . $record['patient_id'] . "\">";?>
<table  id="tabletab" width="900px">
<tr>

	<td>Name</td>
	<td id="namet"><?php echo "<input type=\"text\" id=\"name\" name=\"pname\" style='text-transform:capitalize' value=\"" . $record['name'] . "\">";?></td>
	<td>Age:</td>
	<td>
	<table><tr>
				<td><input type="text" name="age_years" id="age" maxlength="3" size="2" <?php echo "value=\"" . $record['age_years'] . "\"";?> ></td><td>Yrs</td>
				<td><input type="text" id="age_months" name="age_months" size="2" maxlength="2" <?php echo "value=\"" . $record['age_months'] . "\"";?>></td><td>Mths</td>
				<td><input type="text" name="age_days" id="age_days" maxlength="2" size="2" <?php echo "value=\"" . $record['age_days'] . "\"";?>></td><td>Days</td>
	</tr></table>
	</td>
	<td>Date of Birth</td>
	<td><?php echo "<input type=\"text\" id=\"datepicker\" name=\"dob\" value=\""; if($record['dob']!='0000-00-00') {echo "$record[dob]";} echo "\">";?>
	</td>
</tr>
<tr>
	<td>Gender</td>
	<td>
	<?php
	$f = ''; $m = '';if($record['gender']=="F"){$f = 'checked="checked"';} else if($record['gender']=="M"){$m = 'checked="checked"';}
	echo "<input type=\"radio\" name=\"gender\" ondblclick=\"this.checked=!this.checked\" value=\"F\"" . $f . ">Female</input>";
	echo "<input type=\"radio\" name=\"gender\" ondblclick=\"this.checked=!this.checked\" value=\"M\"" . $m . ">Male</input>";
	?>
	</td>
	<td>Department:</td>
	<td>
	<select id="department" name="department" style="max-width:150px;">
	<option selected="selected">--Select--</option>
	<?php
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");
	$sql=mysql_query("select * from departments order by department");
	while($row=mysql_fetch_array($sql))
	{
	if($row['department']!=""){
	echo '<option value="'.$row['department_id'].'">'.$row['department'].'</option>';
	 }} ?>
	</select>
	</td>
	<td>District</td>
	<td>
	<?php 
	$dis="$record[district_id]";
	echo "<select name=\"district\">";
	$query_dis_1= "SELECT * 
		FROM districts";
	$result_dis_1 = mysql_query($query_dis_1);
	while ($record_dis_1 = mysql_fetch_array($result_dis_1)){
	if($dis=="$record_dis_1[district_id]"){
	echo "<option value=\"" . $record_dis_1['district_id'] . "\" selected=\"selected\">" . $record_dis_1['district'] . "</option>";
	}else{
	echo "<option value=\"" . $record_dis_1['district_id'] . "\">" . $record_dis_1['district'] . "</option>";
	 }}
	echo "</select>";
	?>
	</td>

</tr>
<tr>
	<td>Chief Complaint</td>
	<td><textarea name="chief_complaint" style='text-transform:capitalize; width:90%' rows="2"></textarea></td>
	<td>OP Date</td>
	<td><input type="text" name="op_date" id="vdatepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>' /></td>
	<td>OP Time</td>
	<td><input type="text" name="op_time" id="vtimepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("g:ia"); ?>'></td>
</tr>
</table>
</fieldset>
</div>
</td>
</tr>
<tr><td><div  align="center" width="100%"><input type="submit" name="repeat_submit" value="Submit"></div></td></tr>
<tr>
<?php if($_SESSION['SESS_USER_ID_TYPE']!=1){ ?>
<td style="padding-left:15px;">
<?php include("tabs/op_repeat_aditional_tabs.php"); ?>
</td>
<?php } ?>
</tr>
</table>
</form>
<?php }
} ?>

<!-- end right div content -->
</div>

<?php include 'footer.php'; ?> 
<!-- end main page content -->
</div>

<!-- end wrap contents of page  -->
</div>
</body>
</html>


























