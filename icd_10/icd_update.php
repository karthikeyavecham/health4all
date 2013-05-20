<?php $thispage = "update"; ?>
<!DOCTYPE html>
 <html>

 <head>
	<script src="../scripts/jquery183.js"></script>
	<script src="icd_update.js"></script>
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
 <?php include 'menubar_icd.php' ;?>

 <!-- begin main page content -->
 <div id="content-main">

 <!-- begin right div content -->
 <div id="right"> 
<h3>Update ICD-10 Code</h3>
<table width="970px"><tr><td width="500px" style="vertical-align:top; border-right:1px solid;">


<?php include("table_form.php");?>


  <?php 
if(isset($_POST['icd10'])) {
 if($_POST['department']!=""){
 $dept= "AND (patient_visits.department_id='" . $_POST['department'] . "')";
 }
 else $dept="";


 if($_POST['unit']!=""){
 $unit= "AND (patient_visits.unit='" . $_POST['unit'] . "')";
 }
 else $unit="";

 if($_POST['area']!=""){
 $area= "AND (patient_visits.area='" . $_POST['area'] . "')";
 }
 else $area="";

 if($_POST['category']=="unfilled"){
 $cat = "AND (icd_10='')";
 } else if($_POST['category']=="filled") {
 $cat = "AND (icd_10!='')";
 } else {
 $cat = ""; }
 
echo "<b><u>Period</u> : </b>" . date("jS M Y", strtotime($_POST['from_date'])) . " to " . date("jS M Y", strtotime($_POST['to_date']));
echo " &nbsp;&nbsp;<b><u>Category</u> : </b>" . ucfirst($_POST['category']);
echo " <br><b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";}
echo " &nbsp;&nbsp;<b><u>Unit</u> : </b>"; $query_unit= "SELECT * FROM units WHERE unit_id='" . $_POST['unit'] . "'"; $result_unit = mysql_query($query_unit); $record_unit = mysql_fetch_array($result_unit); if($record_unit['unit_name']==""){echo"ALL";}else{echo "$record_unit[unit_name]";}
echo " &nbsp;&nbsp;<b><u>Area</u> : </b>"; $query_area= "SELECT * FROM areas WHERE area_id='" . $_POST['area'] . "'"; $result_area = mysql_query($query_area); $record_area = mysql_fetch_array($result_area); if($record_area['area_name']==""){echo"ALL";}else{echo "$record_area[area_name]";} echo"<br><br>";

 
 
//connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $viewquery = "	SELECT patient_visits.patient_id \"pid\", icd_10, icd_10_ext, name, final_diagnosis
				FROM patient_visits 
				JOIN patients 
				ON patient_visits.patient_id = patients.patient_id
				WHERE ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')" . $cat . $dept . $unit . $dept .")";
			
$result = mysql_query($viewquery);
 if(mysql_num_rows($result) != 0) {
?>
<form name="form1" method="post" action="update.php">
<?php 
echo "Click Here to Update Icd 10 codes : <input type=\"submit\" style=\"width:150px;\" name=\"Submit1\" value=\"Update\"></div>";
?>
<div class="scrollbar" style="width: 540px; height: 400px;">
Select the patient to be filled
<table id="table-icd">
<thead>
<th>Pid</th>
<th>Name</th>
<th>Final Diagnosis</th>
<th>Icd</th>
<th>Ext</th>
<th>Select</th>
</thead><tbody>
<?php
echo "<input type=\"hidden\" name=\"fill\" id=\"fill\" value=\"\">";
$i=0;
while($rows=mysql_fetch_array($result)){
echo "<tr>";
echo "<td align=\"center\">";
echo "<input type='hidden' name='id[]' value='".$rows['pid']."'>";
echo $rows['pid'];
echo "</td>";
echo "<td>";
echo $rows['name'];
echo "</td>";
echo "<td>";
echo $rows['final_diagnosis'];
echo "</td>";
echo "<td align=\"center\">";
echo "<input name=\"icd_10[]\" type=\"text\" value=\"".$rows['icd_10']."\" size=\"2\" maxlength=\"3\">";
echo "</td>";
echo "<td align=\"center\">";
echo "<input name=\"icd_10_ext[]\" type=\"text\" value=\"".$rows['icd_10_ext']."\" size=\"1\" maxlength=\"1\">";
echo "</td>";
echo "<td>";
echo "<input name=\"checkbox\" id=\"checkbox\" class=\"checkbox\" type=\"checkbox\" value=\"".$i."\">";
echo "</td>";
echo "</tr>";
++$i;
}
?>
</tbody>
</table>

</form>

<?php
}
else
Echo "<br><br><b style=\"color:red;\">All ICD 10 Codes are filled in these given dates</b>";
}
?>
</td><td style="vertical-align:top;" align="center">
<div align='left'><b><u>Search by Chapters</u></b><br>
Select : Chapter--> Block--> Code and Click fill
</div>

<?php include ("icd_selection.php");?>

<table><tr>
<td style="width:47%"><hr/></td>
<td style="vertical-align:middle; text-align: center"><b>OR</b></td>
<td style="width:47%"><hr/></td>
</tr></table>
<div align='left'><b><u>Search by Key Word</u></b><br>
Search for icd.10 code and Click on the ICD 10 to fill 
</div>
 	<form action="/" method="post" id="search_engine">
    <input type="text" name="search_code">
    <input type="submit" value="Search">
    </form>
    <div id="result_display" class="scrollbar" style="width: 350px; height: 320px;"></div>

</td></tr></table>
<!-- end right div content -->
 </div>
 <?php include '../footer.php'; ?>
 <!-- end main page content -->
 </div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
