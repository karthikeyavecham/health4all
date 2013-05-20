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

	$chart = new HorizontalBarChart(700, 400);

	$dataSet = new XYDataSet();
	
	
	
	$query_1= "SELECT
          department \"Department\",
          SUM(CASE WHEN visit_id = admit_id  THEN 1 ELSE 0 END) \"IP\"
		  FROM patient_visits
		  JOIN patients ON patients.patient_id = patient_visits.patient_id
		  JOIN departments ON patient_visits.department_id = departments.department_id
		  WHERE  ((admit_date BETWEEN '".$_POST['from_date']. "' AND '" . $_POST['to_date'] ."') AND (visit_type='IP'))
          GROUP BY department";
          
 $result_1 = mysql_query($query_1);
 while ($record_1 = mysql_fetch_array($result_1)){
	if($record_1['Department']!=""){
 	$dataSet->addPoint(new Point("" . $record_1['Department'] . "",$record_1['IP']));
	}}
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 80));

	$chart->setTitle("Department Wise IP Admissions");
	$chart->render("../images/generated/dept_wise_ip_bar.png");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Horizontal bars chart"  src="../images/generated/dept_wise_ip_bar.png" style="border: 1px solid gray;"/>
</body>
</html>
