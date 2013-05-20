<?php
	 //connect to database
 $patient_id= $record['patient_id'];
 $query= "SELECT * 
		FROM patient_visits 
		JOIN departments 
		ON patient_visits.department_id = departments.department_id
		WHERE patient_visits.patient_id='". $patient_id ."'
		ORDER BY visit_id DESC";

 //connect to database
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");		 
		 
 $result = mysql_query($query);
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<th>Sno</th>"; echo "<th>Date</th>"; echo "<th>Type</th>"; echo "<th>Visit id</th>"; echo "<th>IP No</th>"; echo "<th>Department</th>"; echo "<th>Complaint</th>"; echo "<th>Final Diagnosis</th>"; echo "<th>Discharge Date</th>";  
 echo "</thead>";
 echo "<tbody>";
 $sno=1;
 while ($record = mysql_fetch_array($result)){
 
 echo "<tr>";
 echo "<td>" . $sno . "</td>";
 echo "<td>" . date("d M Y", strtotime($record['admit_date'])) . "</td>";
 echo "<td>" . $record['visit_type'] . "</td>";
 echo "<td>" . $record['visit_id'] . "</td>";
 echo "<td>" . $record['hosp_file_no'] . "</td>";
 echo "<td>" . $record['department'] . "</td>";
 echo "<td>" . $record['presenting_complaints'] . "</td>";
 echo "<td>" . $record['final_diagnosis'] . "</td>";
 echo "<td>" . date("d M Y", strtotime($record['outcome_date'])) . "</td>";
 echo "</tr>";
 $sno++;
  }
 echo "</tbody>";
 echo "</table>";
 mysql_close();
 ?>