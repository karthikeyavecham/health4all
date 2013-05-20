<?php
	/* Libchart - PHP chart library
	 * Copyright (C) 2005-2011 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
	 * 
	 * This program is free software: you can redistribute it and/or modify
	 * it under the terms of the GNU General Public License as published by
	 * the Free Software Foundation, either version 3 of the License, or
	 * (at your option) any later version.
	 * 
	 * This program is distributed in the hope that it will be useful,
	 * but WITHOUT ANY WARRANTY; without even the implied warranty of
	 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 * GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License
	 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
	 * 
	 */
	
	/**
	 * Horizontal bar chart demonstration
	 *
	 */

	include "../charts/libchart/classes/libchart.php";

	$chart = new HorizontalBarChart(350, 400);

	$dataSet = new XYDataSet();
	
	
	
	$query_1= "SELECT
	      patients.district_id,
          district \"District\",
          SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"IP\"
		  FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  INNER JOIN districts ON patients.district_id = districts.district_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')".$dept . $unit . $area . $gender.")
          GROUP BY district
		  ORDER BY patients.district_id DESC";
          
 $result_1 = mysql_query($query_1);
 while ($record_1 = mysql_fetch_array($result_1)){
 	$dataSet->addPoint(new Point("" . $record_1['District'] . "",$record_1['IP']));
	}
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 80));

	$chart->setTitle("District Wise IP Admissions");
	$chart->render("../images/generated/district_wise_ip_bar.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="../images/generated/district_wise_ip_bar.png" style="border: 1px solid gray;"/>
</body>
</html>
