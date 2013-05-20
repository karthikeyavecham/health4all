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
	 * Line chart demonstration
	 *
	 */

	include "../charts/libchart/classes/libchart.php";

	$chart = new LineChart(800,400);

	$dataSet = new XYDataSet();
	
	
 $result_1 = mysql_query($query);
 while ($record_1 = mysql_fetch_array($result_1)){
	$dataSet->addPoint(new Point("". $arr_m[$record_1['Month']] ." (". $record_1['Year'].")",$record_1['OP']));
	}
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 60, 80, 50));
	$chart->setTitle("Month Wise IP Admissions");
	$chart->render("../images/generated/month_wise_op_line.png");
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Line chart" src="../images/generated/month_wise_op_line.png" style="border: 1px solid gray;"/>
</body>
</html>