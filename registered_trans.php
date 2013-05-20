<?php $thispage = "registration_ip_trans"; ?>
<!DOCTYPE html>
 <html>

 <head>
<!-- Scripts for printing output table -->
<script type="text/javascript">  
        function PrintDiv1() {    
           var divToPrint = document.getElementById('divToPrint1');
           var popupWin = window.open('', '_blank', 'width=1000,height=600');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
		   popupWin.document.close();		
                }
				
		function PrintDiv2() {    
           var divToPrint = document.getElementById('divToPrint2');
           var popupWin = window.open('', '_blank', 'width=1000,height=600');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
           popupWin.document.close();
                }
     </script>



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
 
 <?php
echo "<h4>Registration Successful<h4>";
$patient_id = $_GET['patient_id'];
$visit_id=$_GET['visit_id'];
$query= "SELECT * 
		FROM patients 
		INNER JOIN patient_visits 
		ON patients.patient_id = patient_visits.patient_id
		INNER JOIN departments
		ON patient_visits.department_id = departments.department_id
		WHERE (patients.patient_id='". $patient_id ."' AND patient_visits.visit_id='". $visit_id ."')";

 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");		 
		 
 $result = mysql_query($query);

while ($record = mysql_fetch_array($result)){
 echo "<table border=\"1\" >";
 echo "<tr>";
 echo "<th colspan=\"2\" align=\"center\" height=\"20\" valign=\"top\">Patient Details</th>";
 echo "</tr>";
 echo "<tr>";
 echo "<td>Patient ID</td>";
 echo "<td>" . $patient_id . "</td>";
 echo "</tr>";
 echo "<tr>";
 echo "<td>Visit ID</td>";
 echo "<td>" . $record['admit_id'] . "</td>";
 echo "</tr>";
 echo "<tr>";
 echo "<td>IP No</td>";
 echo "<td>" . $record['hosp_file_no'] . "</td>";
 echo "</tr>";
 echo "<tr>";
 echo "<td>Admit/Visit Date</td>"; 
 echo "<td>"; if($record['admit_date']!='0000-00-00') {echo date("d M Y", strtotime($record['admit_date']));} echo "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Name</td>";
 echo "<td>" . $record['name'] . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Date of Birth</td>";
 echo "<td>"; if($record['dob']!='0000-00-00') {echo date("d M Y", strtotime($record['dob']));} echo "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Age</td>";
 echo "<td>" . $record['age_years'] . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Gender</td>";
 echo "<td>" . $record['gender'] . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Place</td>";
 echo "<td>" . $record['place'] . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Department</td>";
 echo "<td>" . $record['department'] . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td>Chief Complaint</td>";
 echo "<td>" . $record['presenting_complaints'] . "</td>";
 echo "</tr>";
 echo "<tr>";
 echo "<td colspan=\"2\" align=\"center\">" . "<button type=\"button\" onClick=\"PrintDiv1()\">Print On Ticket</button>" ."&nbsp;&nbsp;&nbsp;&nbsp;" . "<button type=\"button\" onClick=\"PrintDiv2()\">Complete Print</button>" . "</td>";
 echo "</tr>";  
 echo "</table>";
 }
?>


<div id="divToPrint1" style="display:none;visibility:hidden">
<?php
$patient_id = $_GET['patient_id'];
$visit_id=$_GET['visit_id'];
$query= "SELECT * 
		FROM patients 
		INNER JOIN patient_visits 
		ON patients.patient_id = patient_visits.patient_id
		INNER JOIN departments
		ON patient_visits.department_id = departments.department_id
		WHERE (patients.patient_id='". $patient_id ."' AND patient_visits.visit_id='". $visit_id ."')";
 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");		 
		 
 $result = mysql_query($query);

while ($record = mysql_fetch_array($result)){
echo "<div>";
 echo "<div style=\"position:absolute;top:0%;left:47%\">" . $record['patient_id'] . "</div>";
 echo "<div style=\"position:absolute;top:0.1%;left:81%\">" . date("d M Y", strtotime($record['admit_date'])) . "</div>";
 echo "<div style=\"position:absolute;top:2.35%;left:36.08%\">" . $record['name'] . "</div>";
 echo "<div style=\"position:absolute;top:2.65%;left:82%\">" . date("g:ia", strtotime($record['admit_time'])) . "</div>";
 echo "<div style=\"position:absolute;top:4.9%;left:34%\">". $record['age_years'] . "</div>";
 echo "<div style=\"position:absolute;top:4.9%;left:58.4%\">". $record['gender'] . "</div>";
 echo "<div style=\"position:absolute;top:4.9%;left:84.7%\">" . $record['department'] ."</div>";
 echo "<div style=\"position:absolute;top:7.3%;left:74.7%\">Room No : " . $record['op_room_no'] . "</div>";
 echo "<div style=\"position:absolute;top:11.1%;left:49.4%\">" . $record['presenting_complaints'] . "</div>";
 echo "</div>";
 }
 ?>
<!-- end print div content -->
</div>

<!-- begin print 2 div content -->
<div id="divToPrint2" style="display:none;visibility:hidden">
 <?php
$patient_id = $_GET['patient_id'];
$visit_id=$_GET['visit_id'];
$query= "SELECT * 
		FROM patients 
		INNER JOIN patient_visits 
		ON patients.patient_id = patient_visits.patient_id
		INNER JOIN departments
		ON patient_visits.department_id = departments.department_id
		WHERE (patients.patient_id='". $patient_id ."' AND patient_visits.visit_id='". $visit_id ."')";		 
 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");		 
		 
 $result = mysql_query($query);

while ($record = mysql_fetch_array($result)){
 echo "<br>"; echo "<br>"; 
 echo "<table border=\"0\" Width=70% >";
 echo "<tr>";
 echo "<th colspan=\"3\" align=\"center\" height=\"20\" valign=\"top\"><u>Out-Patient Ticket</u></th>";
 echo "<tr>";
 echo "<tr>"; echo "</tr>";
 echo "<tr>";
 echo "<td colspan=\"2\">" . "<b>OP.No : </b>" . $record['patient_id'] . "</td>";
 echo "<td>" . "<b>Date : </b>" . date("d M Y", strtotime($record['admit_date'])) . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td colspan=\"2\">" . "<b>Name : </b>" . $record['name'] . "</td>";
 echo "<td><b>Time : </b></td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td width=34%>" . "<b>Age : </b>" . $record['age_years'] . "</td>";
 echo "<td width=33%>" . "<b>Gender : </b>" . $record['gender'] . "</td>";
 echo "<td width=33%>" . "<b>Ref.to : </b>" . $record['department'] . "-" . $record['op_room_no'] . "</td>";
 echo "</tr>"; 
 echo "<tr>";
 echo "<td colspan=\"3\">" . "<b>Chief Complaint : </b>" . $record['presenting_complaints'] . "</td>";
 echo "</tr>";
 echo "</table>";
 }
?>
<!-- end print 2 div content -->
</div>

 <!-- end right div content -->
 </div>

 <?php include 'footer.php'; ?> <!-- end main page content -->
 <!-- end main page content -->
 </div>

 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>







 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
