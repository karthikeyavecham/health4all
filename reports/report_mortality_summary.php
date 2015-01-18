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

outcome_date

 <!--menubar-->
 <?php include '../menubar_reports.php' ;?>

 <!-- begin main page content -->
 <div id="content-main">
 
 <!-- begin right div content -->
 <div id="right">
 
 <h3>Report : Mortality</h3>

<form action="report_mortality_summary.php" method="post">
<?php require_once "report_classes/table_form_mortality.php";?>
</form>
<br>

<?php
 if (isset($_POST['submit'])){

 //connect to database
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 
 if($_POST['department']!=""){
 $dept= "AND (patient_visits.department_id='" . $_POST['department'] . "')";
 }
 else $dept="";

 if ($_POST['delivery_location_type']!=""){
 $in_out_born="AND (patients.delivery_location_type='" . $_POST['delivery_location_type'] . "')";}
 else $in_out_born="";

 if ($_POST['gest_weeks']!=""){
	if ($_POST['gest_weeks']==">37"){
 		$gest=" AND (gestation > 37 )";}
	if ($_POST['gest_weeks']=="<34"){
 		$gest=" AND (gestation < 34 )";}
	if ($_POST['gest_weeks']=="34-37"){ $gest=" AND (gestation BETWEEN 34 AND 37)";}
 }else $gest="";
 
 if($_POST['from_wt_kgs']=="") {$_POST['from_wt_kgs']="0";}
 if($_POST['from_wt_gms']=="") {$_POST['from_wt_gms']="0";}
 if($_POST['to_wt_kgs']=="") {$_POST['to_wt_kgs']="0";}
 if($_POST['to_wt_gms']=="") {$_POST['to_wt_gms']="0";}
  
 if($_POST['from_wt_kgs']!="0"){
	$from_weight = ($_POST['from_wt_kgs']*1000)+$_POST['from_wt_gms'];
	} else {
	$from_weight = $_POST['from_wt_gms'];
	}
 if($_POST['to_wt_kgs']!="0"){
	$to_weight = ($_POST['to_wt_kgs']*1000)+$_POST['to_wt_gms'];
	} else {
	$to_weight = $_POST['to_wt_gms'];
	}
 
 if(($from_weight=="" OR $from_weight=="0") OR ($to_weight=="" OR $to_weight=="0")){
 $weight="";
 }
 else if($from_weight > $to_weight){ 
 $weight=""; echo "<b style=\"color:red;\">Error: From weight > To weight</b></br>";
 } else {
 $weight=" AND (admit_weight BETWEEN '".$from_weight. "' AND '" . $to_weight ."')";
 }
 
 if($_POST['from_age_yrs']=="") {$_POST['from_age_yrs']="0";}
 if($_POST['to_age_yrs']=="") {$_POST['to_age_yrs']="0";}
 if($_POST['from_age_mts']=="") {$_POST['from_age_mts']="0";}
 if($_POST['to_age_mts']=="") {$_POST['to_age_mts']="0";}
 if($_POST['from_age_days']=="") {$_POST['from_age_days']="0";}
 if($_POST['to_age_days']=="") {$_POST['to_age_days']="0";}

if(($_POST['from_age_yrs'] > $_POST['to_age_yrs']) OR ($_POST['from_age_mts'] > $_POST['to_age_mts']) OR ($_POST['from_age_days'] > $_POST['to_age_days'])) { 
   $age=""; echo "<b style=\"color:red;\">Error: From Age > To Age</b></br>";} else {
 
 if($_POST['from_age_yrs']=="0" AND $_POST['to_age_yrs']=="0"){
	$age_years = "";	
	} else {
	$age_years = " AND (age_years BETWEEN '". $_POST['from_age_yrs'] . "' AND '". $_POST['to_age_yrs'] ."')";
	}
 
 if($_POST['from_age_mts']=="0" AND $_POST['to_age_mts']=="0"){
	$age_months = "";	
	} else {
	$age_months = " AND (age_months BETWEEN '". $_POST['from_age_mts'] . "' AND '". $_POST['to_age_mts'] ."')";
	}
 
 if($_POST['from_age_days']=="0" AND $_POST['to_age_days']=="0"){
	$age_days = "";	
	} else {
	$age_days = " AND (age_days BETWEEN '". $_POST['from_age_days'] . "' AND '". $_POST['to_age_days'] ."')";
	}

 $age= $age_years . $age_months . $age_days;
 }
 
 if($_POST['gender']!=""){
 $gender= "AND (patients.gender='" . $_POST['gender'] . "')";
 }
 else $gender="";
 
 $unit=""; $i=0;
 foreach($_POST['unit'] as $un) {
 if($un!=""){
 if($i==0){
 $unit="(patient_visits.unit='" . $un . "')";
 }else{ 
 $unit= $unit . "OR (patient_visits.unit='" . $un . "')";
 }}
 else {$unit=""; break; }
 $i++;}
 
 if($unit!='') {
 $unit= "AND (" .$unit. ")";
 }
  
 $area=""; $i=0;
 foreach($_POST['area'] as $ar) {
 if($ar!=""){
 if($i==0){
 $area="(patient_visits.area='" . $ar . "')";
 }else{ 
 $area= $area . "OR (patient_visits.area='" . $ar . "')";
 }}
 else {$area=""; break; }
 $i++;}
 
 if($area!='') {
 $area= "AND (" .$area. ")";
 }
 
 echo "<b><u>Report Period</u> : </b>" . date("jS M Y", strtotime($_POST['from_date'])) . " to " . date("jS M Y", strtotime($_POST['to_date'])) . "</br>";
 echo "<b><u>Department</u> : </b>"; $query_dept= "SELECT * FROM departments WHERE department_id='" . $_POST['department'] . "'"; $result_dept = mysql_query($query_dept); $record_dept = mysql_fetch_array($result_dept); if($record_dept['department']==""){echo"ALL";}else{echo "$record_dept[department]";} if(isset($_POST['unit'])){
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Unit</u> : </b>"; $a=0; foreach($_POST['unit'] as $un) { if($un!=""){$query_unit= "SELECT * FROM units WHERE unit_id='" . $un . "'"; $result_unit = mysql_query($query_unit); $record_unit = mysql_fetch_array($result_unit); if($a!='0'){echo ", ";} echo $record_unit['unit_name']; $a++;} else {echo "ALL"; break;}}  
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Area</u> : </b>"; $a=0; foreach($_POST['area'] as $ar) { if($ar!=""){$query_area= "SELECT * FROM areas WHERE area_id='" . $ar . "'"; $result_area = mysql_query($query_area); $record_area = mysql_fetch_array($result_area); if($a!='0'){echo ", ";} echo $record_area['area_name']; $a++;} else {echo "ALL"; break;}} } 
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Gender</u> : </b>"; if($_POST['gender']=="M"){echo "Male";} elseif($_POST['gender']=="F"){echo "Female";} else {echo "ALL";} echo"</br>";
 echo "<b><u>Weight</u> : </b>"; if($weight!="") {echo"From (" . $_POST['from_wt_kgs'] . "kgs " . $_POST['from_wt_gms'] . "gms) To (" . $_POST['to_wt_kgs'] . "kgs " . $_POST['to_wt_gms'] . "gms)";} else {echo "ALL";}
 echo "&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Age</u> : </b>"; if($age!="") {echo"From (" . $_POST['from_age_yrs'] . "yrs " . $_POST['from_age_mts'] . "mths " . $_POST['from_age_days'] . "days) To (" . $_POST['to_age_yrs'] . "yrs " . $_POST['to_age_mts'] . "mths " . $_POST['to_age_days'] . "days)"; } else {echo "ALL";} 
if($_POST['gest_weeks'])
{echo "&nbsp;&nbsp;&nbsp;<b><u>Gestation</u> : ". $_POST['gest_weeks'] ."</b>";}
else{echo "&nbsp;&nbsp;&nbsp;<b><u>Gestation</u></b> : ALL";}
if($_POST['delivery_location_type'])
{echo "&nbsp;&nbsp;&nbsp;<b><u>Delivery Location Type</u> : ". $_POST['delivery_location_type'] ."BORN"."</b>";}
else{echo "&nbsp;&nbsp;&nbsp;<b><u>Delivery Location Type</u></b> : ALL";}
 
 $query=		"SELECT
				Month(admit_date) \"Month\",
				Year(admit_date) \"Year\",
				SUM(CASE WHEN visit_id = admit_id AND outcome!= 'transfer' THEN 1 ELSE 0 END) \"IP\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome!= 'transfer' THEN 1 ELSE 0 END) \"TIP\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = '' THEN 1 ELSE 0 END) \"ND\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = '' THEN 1 ELSE 0 END) \"TND\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'discharge' THEN 1 ELSE 0 END) \"D\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'discharge' THEN 1 ELSE 0 END) \"TD\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'lama' THEN 1 ELSE 0 END) \"L\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'lama' THEN 1 ELSE 0 END) \"TL\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'absconded' THEN 1 ELSE 0 END) \"A\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'absconded' THEN 1 ELSE 0 END) \"TA\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'death' THEN 1 ELSE 0 END) \"DH\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'death' THEN 1 ELSE 0 END) \"TDH\"				
			FROM patient_visits INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
			WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')" . $dept . $unit . $area . $gender . $weight . $gest . $in_out_born . $age . ")
			GROUP BY Month(admit_date), Year(admit_date)
			ORDER BY Year(admit_date),Month(admit_date) ASC";

 $result = mysql_query($query);
 if(mysql_num_rows($result) != 0) {
echo "</br>";
 echo "Note:";
 echo "Mortality = Deaths / (Admissions - Not Discharged cases)";

 $i=1;
 echo "<table id=\"table-his\">";
 echo "<thead>";
 echo "<tr><th rowspan=\"2\">S.no</th>"; echo "<th rowspan=\"2\">Year</th>"; echo "<th rowspan=\"2\">Month</th>"; echo "<th rowspan=\"2\">Admissions</th>"; echo "<th rowspan=\"2\" align=\"center\">Not Discharged</th>"; echo "<th colspan=\"4\" align=\"center\">Discharged</th>";  echo "<th rowspan=\"2\" align=\"center\">Death</th>"; echo "<th rowspan=\"2\" align=\"center\">Mortality %</th></tr>"; 
 echo "<tr><th>Normal</th>"; echo "<th>LAMA</th>"; echo "<th>Absconded</th>"; echo "<th>Total</th>";
 echo "</thead>";
    $csv_hdr = " S.no,Year,Month,Admissions,Not Discharged,Normal, LAMA, Absconded, Total, Death, Mortality %";
    $csv_output="";
 echo "<tbody>";
 $arr_m = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
 while ($record = mysql_fetch_array($result)){
 $totalIP=$record['IP']+$record['TIP'];
 $totalND=$record['ND']+$record['TND'];
 $totalD=$record['D']+$record['TD'];
 $totalL=$record['L']+$record['TL'];
 $totalA=$record['A']+$record['TA'];
 $total=$totalD+$totalL+$totalA;
 $totalDH=$record['DH']+$record['TDH'];
 if(($record['IP']-$record['ND'])!=0){
 $MNT=number_format((($record['DH']/($record['IP']-$record['ND']))*100),1);
 } else $MNT="0.0";
 if(($record['TIP']-$record['TND'])!=0){
 $MT=number_format((($record['TDH']/($record['TIP']-$record['TND']))*100),1);
 } else $MT="0.0";
 if(($totalIP-$totalND)!=0){
 $totalM=number_format((($totalDH/($totalIP-$totalND))*100),1);
 } else $totalM="0.0";
 echo "<tr>";
 echo "<td>".$i."</td>";
$csv_output .= $i . ", ";
 echo "<td>". $record['Year'] ."</td>";
$csv_output .= $record['Year'] . ", ";
 echo "<td>". $arr_m[$record['Month']] ."</td>";
$csv_output .= $record['Month'] . ", ";
 echo "<td>". $totalIP ."</td>";
$csv_output .= $totalIP . ", ";
 echo "<td>". $totalND ."</td>";
$csv_output .= $totalND . ", ";
 echo "<td>". $totalD ."</td>";
$csv_output .= $totalD . ", ";
 echo "<td>". $totalL ."</td>";
$csv_output .= $totalL . ", ";
 echo "<td>". $totalA ."</td>";
$csv_output .= $totalA . ", ";
 echo "<td>". $total ."</td>";
$csv_output .= $total . ", ";
 echo "<td>". $totalDH ."</td>";
$csv_output .= $totalDH . ", ";
 echo "<td>". $totalM ."</td>";
$csv_output .= $totalM . "\n ";
 echo "</tr>";
 $i++;
 }
 $query_total=	"SELECT
				Month(admit_date) \"Month\",
				Year(admit_date) \"Year\",
				SUM(CASE WHEN visit_id = admit_id AND outcome!= 'transfer' THEN 1 ELSE 0 END) \"IP\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome!= 'transfer' THEN 1 ELSE 0 END) \"TIP\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = '' THEN 1 ELSE 0 END) \"ND\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = '' THEN 1 ELSE 0 END) \"TND\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'discharge' THEN 1 ELSE 0 END) \"D\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'discharge' THEN 1 ELSE 0 END) \"TD\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'lama' THEN 1 ELSE 0 END) \"L\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'lama' THEN 1 ELSE 0 END) \"TL\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'absconded' THEN 1 ELSE 0 END) \"A\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'absconded' THEN 1 ELSE 0 END) \"TA\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'death' THEN 1 ELSE 0 END) \"DH\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'death' THEN 1 ELSE 0 END) \"TDH\"				
			FROM patient_visits INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
			WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')" . $dept . $unit . $area . $gender . $weight . $gest . $in_out_born . $age . ")";
 
 $result_total = mysql_query($query_total);
 echo "</tbody><tfoot>";
 while ($record_total = mysql_fetch_array($result_total)){
 $totalIP=$record_total['IP']+$record_total['TIP'];
 $totalND=$record_total['ND']+$record_total['TND'];
 $totalD=$record_total['D']+$record_total['TD'];
 $totalL=$record_total['L']+$record_total['TL'];
 $totalA=$record_total['A']+$record_total['TA'];
 $total=$totalD+$totalL+$totalA;
 $totalDH=$record_total['DH']+$record_total['TDH'];
 if(($record_total['IP']-$record_total['ND'])!=0){
 $MNT=number_format((($record_total['DH']/($record_total['IP']-$record_total['ND']))*100),1);
 } else $MNT="0.0";
 if(($record_total['TIP']-$record_total['TND'])!=0){
 $MT=number_format((($record_total['TDH']/($record_total['TIP']-$record_total['TND']))*100),1);
 } else $MT="0.0";
 if(($totalIP-$totalND)!=0){
 $totalM=number_format((($totalDH/($totalIP-$totalND))*100),1);
 } else $totalM="0.0";
 echo "<tr><b>";
 echo "<td colspan='3' align='center'>Total</td>";
 echo "<td>". $totalIP ."</td>";
 echo "<td>". $totalND ."</td>";
 echo "<td>". $totalD ."</td>";
 echo "<td>". $totalL ."</td>";
 echo "<td>". $totalA ."</td>";
 echo "<td>". $total ."</td>";
 echo "<td>". $totalDH ."</td>";
 echo "<td>". $totalM ."</td>";
 echo "</b></tr>";
  }
 
 echo "</tfoot>";
 echo "</table>";

 }
 
 else
 {
 echo "<br><br><b style=\"color:red;\">No data in this given dates</b>";
 } ?>

<link rel="stylesheet" href="../amcharts/samples/style.css" type="text/css">
<script src="../amcharts/amcharts/amcharts.js" type="text/javascript"></script>
  
<div id="chartdiv" align="center" style="width: 800px; height: 400px;"></div>		
		
<script type="text/javascript">
            var chart;
            var chartData = [
				<?php
				$query_chart = "SELECT
				Month(admit_date) \"Month\",
				Year(admit_date) \"Year\",
				SUM(CASE WHEN visit_id = admit_id AND outcome!= 'transfer' THEN 1 ELSE 0 END) \"IP\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome!= 'transfer' THEN 1 ELSE 0 END) \"TIP\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = '' THEN 1 ELSE 0 END) \"ND\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = '' THEN 1 ELSE 0 END) \"TND\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'discharge' THEN 1 ELSE 0 END) \"D\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'discharge' THEN 1 ELSE 0 END) \"TD\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'lama' THEN 1 ELSE 0 END) \"L\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'lama' THEN 1 ELSE 0 END) \"TL\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'absconded' THEN 1 ELSE 0 END) \"A\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'absconded' THEN 1 ELSE 0 END) \"TA\",
				SUM(CASE WHEN visit_id = admit_id AND outcome = 'death' THEN 1 ELSE 0 END) \"DH\",
				SUM(CASE WHEN visit_id!= admit_id AND outcome = 'death' THEN 1 ELSE 0 END) \"TDH\"
				FROM patient_visits INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
				WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')" . $dept . $unit . $area . $gender . $weight . $gest . $in_out_born . $age . ")
				GROUP BY Month(admit_date), Year(admit_date)
				ORDER BY Year(admit_date),Month(admit_date) ASC";
				$result_chart = mysql_query($query_chart);
				$i=1;
				while ($record_chart = mysql_fetch_array($result_chart))
				{
					$totalIP=0;
 					$totalIP=$record_chart['IP']+$record_chart['TIP'];
					$totalL=$record_chart['L']+$record_chart['TL'];
					$totalDH=$record_chart['DH']+$record_chart['TDH'];
					$totalA=$record_chart['A']+$record_chart['TA'];
					

				if($i!=1){ echo","; }
				echo "{ Year:" . $record_chart['Year'] . ", LAMA:" . $totalL . ", DEATH:" . $totalDH . ", ABSCONDED:" . $totalA . ", ADMISSIONS:" . $totalIP . ",}";
				$i++;
				}?>
			];


            AmCharts.ready(function () {
                // SERIAL CHART  
                chart = new AmCharts.AmSerialChart();
                chart.pathToImages = "../amcharts/amcharts/images/";
                chart.dataProvider = chartData;
                chart.categoryField = "Year";
                chart.startDuration = 1;

                // AXES
                // category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
				categoryAxis.parseDates = false;
				
				
                // value
                // in case you don't want to change default settings of value axis,
                // you don't need to create it, as one value axis is created automatically.
                
                // GRAPHS
                // column graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Lama";
                graph1.valueField = "LAMA";
                graph1.lineAlpha = 0;
                graph1.fillAlphas = 1;
				chart.addGraph(graph1);  	
				
				var graph2 = new AmCharts.AmGraph();
                graph2.type = "column";
                graph2.title = "Death";
                graph2.valueField = "DEATH";
                graph2.lineAlpha = 0;
                graph2.fillAlphas = 1;
				chart.addGraph(graph2);
				
				var graph3 = new AmCharts.AmGraph();
                graph3.type = "column";
                graph3.title = "Absconded";
                graph3.valueField = "ABSCONDED";
                graph3.lineAlpha = 0;
                graph3.fillAlphas = 1;
				chart.addGraph(graph3);	

				var graph4 = new AmCharts.AmGraph();
                graph4.type = "column";
                graph4.title = "Admissions";
                graph4.valueField = "ADMISSIONS";
                graph4.lineAlpha = 0;
                graph4.fillAlphas = 1;
				chart.addGraph(graph4);	

                // var graph2 = new AmCharts.AmGraph();
                // graph2.type = "line";
                // graph2.title = "Line";
                // graph2.valueField = "Line";
                // graph2.lineThickness = 2;
                // graph2.bullet = "round";
                // chart.addGraph(graph2);

                // LEGEND                
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);

                // WRITE
                chart.write("chartdiv");
            });
        </script>


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
