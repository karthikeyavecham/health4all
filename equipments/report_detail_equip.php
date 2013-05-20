<?php $thispage = "equipment"; ?>
<!DOCTYPE html>
 <html>

 <head>
	<script src="../scripts/jquery183.js"></script>
	<script src="equipment.js"></script>	
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

<h3>Equipment Details By Department And Equipment</h3>
 <form action="report_detail_equip.php" method="post">
<table>
<tr>
<th>Department</th>
<th>Equipment Type</th>
</tr><tr><td>
<select name="department">
<option selected="selected" value="">--ALL--</option>
<?php
include("../db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$sql=mysql_query("select * from departments");
while($row=mysql_fetch_array($sql))
{ if($row['department_id']!='0'){
echo '<option value="'.$row['department_id'].'">'.$row['department'].'</option>';
 }} ?>
</select>
</td>
<td>
<?php
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $query_equ= "SELECT * 
		FROM equipment_type";
 $result_equ = mysql_query($query_equ);
 	echo "<select name=\"equipment_type_id\">";
	echo "<option value=\"\" selected=\"selected\">--ALL--</option>";
	while ($record_equ = mysql_fetch_array($result_equ)){
	echo "<option value=\"" . $record_equ['equipment_type_id'] . "\">" . $record_equ['equipment_name'] . "</option>";
	}
	echo "</select>";
?>
</td>
<td>
<input type="submit" name="submit" value="Submit">
</td></tr>
</table> 
</form>
<hr>
 <?php
 if (isset($_POST['submit'])){
	if($_POST['department']!=""){
			$dept = "AND equipments.department_id='" . $_POST['department'] . "'";
			}
	else $dept = "";
	
	if($_POST['equipment_type_id']!=""){
			$equip = "AND equipments.equipment_type_id='" . $_POST['equipment_type_id'] . "'";
			}
	else $equip = "";
	
 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";}
 echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Equipment</u> : </b>"; $query_equip= "SELECT * FROM equipment_type WHERE equipment_type_id='" . $_POST['equipment_type_id'] . "'"; $result_equip = mysql_query($query_equip); $record_equip = mysql_fetch_array($result_equip); if($record_equip['equipment_type_id']==""){echo"ALL";}else{echo "$record_equip[equipment_name]";}			

 $query=	"SELECT 
			equipments.equipment_id \"equip_id\", serial_number, asset_number, equipment_name, department, supplier, supply_date,
			service_engineer, service_engineer_contact, request_id, call_information, call_date, working_status, problem_status
			FROM equipments
			LEFT JOIN service_records ON  service_records.equipment_id = equipments.equipment_id AND service_records.request_id=(select max(request_id) from service_records WHERE service_records.equipment_id = equipments.equipment_id)
			INNER JOIN equipment_type ON equipment_type.equipment_type_id = equipments.equipment_type_id
			INNER JOIN departments ON departments.department_id = equipments.department_id
			WHERE equipment_status='1' " . $dept . $equip;
			
	echo "<br><br>";
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0) {
		$i=1;
		echo "<div class='scrollbar' style='width:940px; height:280px;'>";
		echo "<table id=\"table-icd\">";
		echo "<thead>";
		echo "<tr><th colspan='11' style='border-right:solid 1px;' align='center'>Equipment Details</th>"; echo "<th colspan='5' align='center'>Last Issue Request Details</th></tr>";
		echo "<tr><th></th><th>S.no</th>";  echo "<th>Equipment ID</th>"; echo "<th>Serial Number</th>"; echo "<th>Asset Number</th>"; 
		echo "<th>Equipment Type</th>"; echo "<th>Department</th>";	echo "<th>Supplier</th>"; echo "<th>Suppy date</th>"; echo "<th>Service Engineer</th>"; 
		echo "<th style='border-right:solid 1px;'>Service Eng Number</th>"; echo "<th>Issue Request ID</th>"; 
		echo "<th>Call Info</th>"; echo "<th>Call Date</th>"; echo "<th>Working Status</th>";echo "<th>Problem Status</th>";echo"</tr>"; 
		echo "</thead>";
		echo "<tbody>";
 		while ($record = mysql_fetch_array($result)){
		echo "<tr>";
		echo "<td><input name=\"checkbox[]\" id=\"checkbox\" class=\"checkbox\" type=\"checkbox\" value=\"".$record['equip_id'].".".$record['request_id']."\"></td>";
		echo "<td>".$i."</td>";
		echo "<td>". $record['equip_id'] ."</td>";
		echo "<td>". $record['serial_number'] ."</td>";
		echo "<td>". $record['asset_number'] ."</td>";
		echo "<td>". $record['equipment_name'] ."</td>";
		echo "<td>". $record['department'] ."</td>";
		echo "<td>". $record['supplier'] ."</td>";
		echo "<td>". $record['supply_date'] ."</td>";
		echo "<td>". $record['service_engineer'] ."</td>";
		echo "<td style='border-right:solid 1px;'>". $record['service_engineer_contact'] ."</td>";
		echo "<td>". $record['request_id'] ."</td>";
		echo "<td>". $record['call_information'] ."</td>";
		echo "<td>". $record['call_date'] ."</td>";
		if($record['working_status']=='1'){$working_status="Working";} else if($record['working_status']=='0'){$working_status="Not Working";} else if($record['request_id']==""){$working_status="";}
		echo "<td>". $working_status ."</td>";
		echo "<td>". $record['problem_status'] ."</td>";
		$i++;
		}
		echo "</tbody>";
		
		echo "</table>";
		echo "</div>";
		?>
		<table width="800px">
		<tr><td>
		<?php
		echo "<form action=\"equipment_update.php\" method=\"post\" onsubmit=\"return validate_report_1();\">";
		echo "<input type=\"hidden\" name=\"selected_equip\" id=\"equipment_id_1\" value=\"\">";
		echo "<input type=\"submit\" name=\"ok\"  style=\"width:220px; height:30px;\" value=\"Update This Equipment Details\" >";
		echo "</form>";
		?>
		</td><td>
		<?php
		echo "<form action=\"equip_issue_update.php\" method=\"post\" name=\"up_issue_form\" onsubmit=\"return validate_report_2();\">";
		echo "<input type=\"hidden\" name=\"selected_request\" id=\"request_id_2\" value=\"\">";
		echo "<input type=\"submit\" name=\"go\"  style=\"width:220px; height:30px;\" value=\"Update This Service Issue Details\" >";
		echo "</form>";
		?> 
		</td><td>
		<?php
		echo "<form action=\"equip_issue_reg.php\" method=\"post\" name=\"reg_issue_form\" onsubmit=\"return validate_report_3();\">";
		echo "<input type=\"hidden\" name=\"selected_equip\" id=\"equipment_id_3\" value=\"\">";
		echo "<input type=\"hidden\" id=\"request_id_3\" value=\"\">";
		echo "<input type=\"submit\" name=\"ok\"  style=\"width:220px; height:30px;\" value=\"Register Service Issue\" >";
		echo "</form>";
		?>
		</td></tr>
		</table>
		<?php
	}
	else {echo "<b style=\"color:red\">No Data</b>";}
 
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
