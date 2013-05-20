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
	 * Multiple horizontal bar chart demonstration.
	 *
	 */

	include "../charts/libchart/classes/libchart.php";

	$chart = new HorizontalBarChart(700, $i*50);

	$serie1 = new XYDataSet();
	$serie2 = new XYDataSet();
	
	$query_1= "SELECT
          Month(admit_date) \"Month\",
		  Year(admit_date) \"Year\",
          SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"IP_ADMIN\",
		  SUM(CASE WHEN visit_id != admit_id  THEN 1 ELSE 0 END) \"IP_TRANS\"
		  FROM patient_visits
		  INNER JOIN patients ON patient_visits.patient_id = patients.patient_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP')".$dept . $unit . $area . $gender.")
          GROUP BY Month(admit_date), Year(admit_date)
          ORDER BY Year(admit_date),Month(admit_date) DESC";
          
	$result_1 = mysql_query($query_1);
	$arr_m = array("","January","February","March","April","May","June","July","August","September","October","November","December");
	while ($record_1 = mysql_fetch_array($result_1)){
	$serie1->addPoint(new Point("".$arr_m[$record_1['Month']]."",$record_1['IP_ADMIN']));
	$serie2->addPoint(new Point("".$arr_m[$record_1['Month']]."",$record_1['IP_TRANS']));
	}
	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Admissions", $serie1);
	$dataSet->addSerie("Transfers", $serie2);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 90, 20, 90));

	$chart->setTitle("Admissions Vs Transfers");
	$chart->render("../images/generated/admin_trans_ip_bar.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="../images/generated/admin_trans_ip_bar.png" style="border: 1px solid gray;"/>
</body>
</html>
