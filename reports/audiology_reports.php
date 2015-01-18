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
 
 <h3>Report : Audiology</h3>

<form action="audiology_reports.php" method="post">
<?php require_once "report_classes/table_form_audiology.php";?>
</form>
<br>

<?php
 if (isset($_POST['submit'])){

 //connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 if($_POST['ear']=="Left" && $_POST['outcome']=="Positive"){
 $outcome= "AND (oael_outcome='Positive')";
 }
 else if($_POST['ear']=="Left" && $_POST['outcome']=="Negative"){
 $outcome= "AND (oael_outcome='Negative')";}
else if($_POST['ear']=="Right" && $_POST['outcome']=="Positive"){
 $outcome= "AND (oaer_outcome='Positive')";}
else if($_POST['ear']=="Right" && $_POST['outcome']=="Negative"){
 $outcome= "AND (oaer_outcome='Negative')";
 }
 else $outcome="";
 
 echo "<b><u>Report Period</u> : </b>" . date("jS M Y", strtotime($_POST['from_date'])) . " <b>to</b> " . date("jS M Y", strtotime($_POST['to_date'])) . "</br>";
if($_POST['ear']=="Left"){echo "<b><u>Ear</u> </b>: Left </br>";}elseif($_POST['ear']=="Left"){echo "<b><u>Ear</u></b> : Right </br>";}
else {echo "<b><u>Ear</u></b> : All </br>";}
if($_POST['outcome']=="Positive"){echo "<b><u>Outcome</u> : </b>Positive </br>";}elseif($_POST['outcome']=="Negative"){echo "<b><u>Outcome</u></b> : Negative </br> ";}
else {echo "<b><u>Outcome</u> </b>: All  </br> ";}
if($_POST['contact']=="yes"){echo "<b><u>Want Contact Details</u> : </b>Yes </br>";}elseif($_POST['contact']=="no"){echo "<b><u>Want Contact Details</u></b> : No </br> ";}
 
$one_date=date("Y-m-d", strtotime($_POST['from_date']));
$two_date=date("Y-m-d", strtotime($_POST['to_date']));
$query="SELECT * FROM audiology 
	JOIN patient_visits ON audiology.ip_no=patient_visits.hosp_file_no 
	INNER JOIN patients ON patient_visits.patient_id=patients.patient_id 
	WHERE (date_of_test BETWEEN '".$one_date."' AND '".$two_date."') $outcome";
 $result = mysql_query($query);

 if(mysql_num_rows($result) != 0) {
echo "</br>";
  $i=1;
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<tr><th rowspan=\"1\">S.no</th>"; echo "<th rowspan=\"1\">Name</th>"; echo "<th rowspan=\"1\">OP/IP No.</th>"; echo "<th rowspan=\"1\">Patient Id.</th>"; echo "<th rowspan=\"1\" align=\"center\">Date of Test</th>"; echo "<th colspan=\"1\" align=\"center\">Type of Test</th>";  echo "<th rowspan=\"1\" align=\"center\">Test No.</th>"; echo "<th rowspan=\"1\" align=\"center\">Tested by</th>"; if($_POST['ear']=="Left"||$_POST['ear']==""){echo "<th rowspan=\"1\" align=\"center\">OAE-L Outcome</th>";}if($_POST['ear']=="Right"||$_POST['ear']==""){echo "<th rowspan=\"1\" align=\"center\">OAE-R Outcome</th>"; } if($_POST['contact']=="yes"){echo "<th rowspan=\"1\">Mother/Father Name</th>"; echo "<th rowspan=\"1\">Address/City</th>"; echo "<th rowspan=\"1\">Phone</th>";}echo "<th rowspan=\"1\" align=\"center\">Remarks</th></tr>";
 echo "</thead>";
    $csv_hdr = " S.no, Name, OP/IP No., Patient Id, Date of Test, Type of Test, Audiology Test No, Audiologist Id, OAE-L Outcome, OAE-R Outcome, Remarks";
    $csv_output="";
 echo "<tbody>";
 while ($record = mysql_fetch_array($result)){
 
 echo "<tr>";
 echo "<td>".$i."</td>";
$csv_output .= $i . ", ";
 echo "<td>". $record['name'] ."</td>";
$csv_output .= $record['name'] . ", ";
 echo "<td>". $record['hosp_file_no'] ."</td>";
$csv_output .= $record['hosp_file_no'] . ", ";
 echo "<td>". $record['patient_id'] ."</td>";
$csv_output .= $record['patient_id'] . ", ";
 echo "<td>". date("jS M Y", $record['date_of_test']) ."</td>";
$csv_output .= $record['date_of_test'] . ", ";
 echo "<td>". $record['type_of_test'] ."</td>";
$csv_output .= $record['type_of_test'] . ", ";
echo "<td>". $record['test_no'] ."</td>";
$csv_output .= $record['test_no'] . ", ";
$query2="SELECT * FROM staff 
	JOIN audiology ON audiology.audiologist_id=staff.staff_id
	WHERE audiology.audiologist_id=staff.staff_id
	AND staff_id='".$record['audiologist_id']."'";
 $result2 = mysql_query($query2);
 $record2 = mysql_fetch_array($result2);
 echo "<td>". $record2['name'] ."</td>";
$csv_output .= $record2['name'] . ", ";

if($_POST['ear']=="Left"||$_POST['ear']==""){
 echo "<td>". $record['oael_outcome'] ."</td>";
$csv_output .= $record['oael_outcome'] . ", ";}
if($_POST['ear']=="Right"||$_POST['ear']==""){
 echo "<td>". $record['oaer_outcome'] ."</td>";
$csv_output .= $record['oaer_outcome'] . ", ";}
 if($_POST['contact']=="yes"){
echo "<td>". $record['mother_name'] . "/". $record['father_name'] ."</td>";
$csv_output .= $record['mother_name'] . "/". $record['father_name'] . ", ";
 echo "<td>". $record['address'] ."/". $record['city']."</td>";
$csv_output .= $record['address'] ."/". $record['city'] . ", ";
 echo "<td>". $record['phone'] ."</td>";
$csv_output .= $record['phone'] . ", ";
}
echo "<td>". $record['remarks'] ."</td>";
$csv_output .= $record['remarks'] . "\n";
 echo "</tr>";
 $i++;
 }
 echo "</table>";

 }
 
 else
 
 {
 echo "<br><br><b style=\"color:red;\">No data in these given dates</b>";
 } 
?>
<form name="export" action="export.php" method="post">
<input type="submit" value="Export table to CSV">
<input type="hidden" value="<?php echo $csv_hdr; ?>" name="csv_hdr">
<input type="hidden" value="<?php echo $csv_output; ?>" name="csv_output">
</form>
<input type="submit" value="Print report" onclick="window.print();">
<?php
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
