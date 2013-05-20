<?php $thispage = "equipment"; ?>
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
 <?php include 'menubar_equ.php' ;?>

 <!-- begin main page content -->
 <div id="content-main">

 <!-- begin right div content -->
 <div id="right"> 
<h3>Reports By Department</h3>
 <form action="report_by_dept.php" method="post">
<table>
<tr>
<th>Department</th>
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
</td><td>
<input type="submit" name="submit" value="Submit">
</td></tr>
</table> 
 </form>
 <hr>
 <?php
 if (isset($_POST['submit'])){
	if($_POST['department']!=""){
			$dept = "WHERE equipments.department_id='" . $_POST['department'] . "'";
			}
	else $dept = "";
	
 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";}
			
$query=	"SELECT	
			equipment_type.equipment_name \"equip_name\",
			SUM(CASE WHEN (service_records.equipment_id is NULL OR problem_status='Issue Resolved') AND equipment_status=1 THEN 1 ELSE 0 END) \"working\",
			SUM(CASE WHEN problem_status!='Issue Resolved' AND equipment_status=1 THEN 1 ELSE 0 END) \"notworking\"
			FROM equipments
			LEFT JOIN service_records ON  service_records.equipment_id = equipments.equipment_id AND service_records.request_id=(select max(request_id) from service_records WHERE service_records.equipment_id = equipments.equipment_id)
			INNER JOIN equipment_type ON equipment_type.equipment_type_id = equipments.equipment_type_id
			".$dept." GROUP BY equipments.equipment_type_id";
			
	echo "<br><br>";
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0) {
		$i=1;
		echo "<table id=\"table-his\">";
		echo "<thead>";
		echo "<tr><th>S.no</th>";  echo "<th>Equipment Type</th>"; echo "<th>Working</th>"; echo "<th>Not Working</th>"; echo "<th>Total</th></tr>"; 
		echo "</thead>";
		echo "<tbody>";
 		while ($record = mysql_fetch_array($result)){
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>". $record['equip_name'] ."</td>";
		echo "<td>". $record['working'] ."</td>";
		echo "<td>". $record['notworking'] ."</td>";
		$total=$record['working']+$record['notworking'];
		echo "<td>". $total ."</td>";
		$i++;
		}
		echo "</tbody>";
		echo "<tfoot>";
		
	$query1=	"SELECT	
			equipment_type.equipment_name \"equip_name\",
			SUM(CASE WHEN (service_records.equipment_id is NULL OR problem_status='Issue Resolved') AND equipment_status=1 THEN 1 ELSE 0 END) \"working\",
			SUM(CASE WHEN problem_status!='Issue Resolved' AND equipment_status=1 THEN 1 ELSE 0 END) \"notworking\"
			FROM equipments
			LEFT JOIN service_records ON  service_records.equipment_id = equipments.equipment_id AND service_records.request_id=(select max(request_id) from service_records WHERE service_records.equipment_id = equipments.equipment_id)
			INNER JOIN equipment_type ON equipment_type.equipment_type_id = equipments.equipment_type_id
			".$dept;
	$result1 = mysql_query($query1);
	while ($record1 = mysql_fetch_array($result1)){
		echo "<tr>";
		echo "<td colspan='2' align='center'>Total</td>";
		echo "<td>". $record1['working'] ."</td>";
		echo "<td>". $record1['notworking'] ."</td>";
		$total=$record1['working']+$record1['notworking'];
		echo "<td>". $total ."</td>";
		}
	
		echo "</tfoot>";	
		
		echo "</table>";
	}
	else {echo "<b style=\"color:red\">No Department has this Equipment</b>";}
 
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
