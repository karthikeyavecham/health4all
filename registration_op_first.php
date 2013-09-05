<?php $thispage = "outpatient_first"; ?>
<!DOCTYPE html>
 <html>

 <head>

	<script src="scripts/jquery183.js"></script>
    	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/jquery.ui.core.min.js"></script>
	<script src="scripts/jquery.ui.widget.js"></script>
	<script src="scripts/datepicker.js"></script>
	<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="scripts/validation.js"></script>
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

<h3><u>Out Patient First Visit</u></h3>
<form name="opreg" action="registration_op_exec.php" onsubmit="return validateForm_opreg();" method="post">
<table>
<tr><td>
<div id="form_first" >
	<fieldset >
	<legend><h3>Out-Patient Registration</h3></legend>
		
		<table  id="tabletab" width="900px">
		<tr>
			<td>Name *:</td>
			<td id="namet"><input type="text" id="name" name="name" style='text-transform:capitalize' autofocus TABINDEX=1><BR/></td>
			<td>Age:</td>
			<td>
				<table><tr>
				<td><input type="text" name="age_years" id="age" maxlength="3" size="2" style="text-align:right;" TABINDEX=2></td><td>Yrs</td>
				<td><input type="text" id="age_months" name="age_months" size="2" maxlength="2" style="text-align:right;" TABINDEX=3></td><td>Mths</td>
				<td><input type="text" name="age_days" id="age_days" maxlength="2" size="2" style="text-align:right;" TABINDEX=4></td><td>Days</td>
				</tr></table>
			</td>
			<td>Date of Birth:</td>
			<td><input type="text" id="datepicker" name="dob" ></td>
			
		</tr>
		<tr>
			<td>Gender:</td>
			<td>
			<input type="radio" name="gender" ondblclick="this.checked=!this.checked" value="F" TABINDEX=5>Female
			<input type="radio" name="gender" ondblclick="this.checked=!this.checked" value="M" TABINDEX=6>Male
			</td>
			<td>Department:</td>
			<td>
			<select id="department" name="department" style="max-width:150px;" TABINDEX=7>
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
			<td>District:</td>
			<td>
			<?php
			 include("db_connect.php");
			 mysql_connect("$dbhost","$dbuser","$dbpass");
			 mysql_select_db("$dbdatabase");
			 $query_dis= "SELECT * 
					FROM districts";
			 $result_dis = mysql_query($query_dis);
				echo "<select name=\"district\">";
				echo "<option value=\"\">--Select--</option>";
				while ($record_dis = mysql_fetch_array($result_dis)){
				if($record_dis['district_id']!="0"){
				echo "<option value=\"" . $record_dis['district_id'] . "\">" . $record_dis['district'] . "</option>";
				 }}
				echo "</select>";
			?>
			</td>			
		</tr>
		<tr>
			<td>Chief Complaint:</td>
			<td><textarea name="chief_complaint" style='text-transform:capitalize; width:90%' rows="2" TABINDEX=8></textarea></td>
			<td>OP Date:</td>
			<td><input type="text" name="op_date" id="vdatepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'</td>
			<td>OP Time:</td>
			<td><input type="text" name="op_time" style="width:150px;" id="vtimepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("g:ia"); ?>'></td>
		</tr>
		</table>
		
		
	</fieldset>
 </div>
 </td>
 </tr>
 <tr><td><div  align="center" width="100%"><input type="submit" name="first_submit"  value="Submit" TABINDEX=9></div></td></tr>
 <tr>
 <?php if($_SESSION['SESS_USER_ID_TYPE']!=1){ ?>
 <td style="padding-left:15px;">
 <?php include("tabs/op_first_aditional_tabs.php"); ?>
 </td>
 <?php } ?>
 </tr>
 
 </table>
  </form>
 <!-- end right div content -->
 </div>

 <?php include 'footer.php'; ?>
 <!-- end main page content -->
 </div>

 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>







 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
