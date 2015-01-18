<?php $thispage = "reports"; ?>
<!DOCTYPE html>
 <html>

 <head>
 <!-- link to css style sheet -->
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
 
 <table width=100%>
 <tr>
 <td><h3>OP Statistics</h3></td>
 <td><h3>IP Statistics</h3></td>
 </tr>
 <tr>
 
 
 <td style="vertical-align:top";>
 <li><b>Summary</b>
 <ol>
 <li><a href="report_dept_wise_op.php">Department Wise OP Summary</a>
 <li><a href="report_day_wise_op.php">Day Wise OP Summary</a>
 <li><a href="report_month_wise_op.php">Month Wise OP Summary</a>
 <li><a href="report_district_wise_op.php">District Wise OP Summary</a>
 </ol>
 <li><b>Detail</b>
 <ol>
 <li><a href="report_patient_details_op.php">Out-Patient Details</a>
 </ol>
 </td>
 
 
 <td style="vertical-align:top";>
 <li><b>Summary</b>
 <ol>
 <li><a href="report_dept_wise_ip.php">Department Wise IP Summary</a>
 <li><a href="report_day_wise_ip.php">Day Wise IP Summary</a>
 <li><a href="report_month_wise_ip.php">Month Wise IP Summary</a>
 <li><a href="report_district_wise_ip.php">District Wise IP Summary</a>
 <li><a href="report_monthwise_adim_tran_ip.php">Month Wise Admissions & Trasfers </a>
 <li><a href="report_mortality_summary.php">Mortality Report</a>
 <li><a href="report_mortality.php">Mortality Report (With breakup of transfer cases) </a>
 <li><a href="report_treatment.php">Treatment Reports </a>
 </ol>
 <li><b>Detail</b>
 <ol>
 <li><a href="report_patient_details_ad_ip.php">In-Patient Details (Admissions)</a>
 <li><a href="report_patient_details_nd_ip.php">In-Patient Details (Not Discharged)</a>
 <li><a href="report_patient_details_dd_ip.php">In-Patient Details (Discharged & Deaths)</a>
 <li><a href="report_patient_details_tf_ip.php">In-Patient Details (Transfers)</a>
 <!--<li><a href="report_patient_icd_details.php">In-Patient Details (ICD 10)</a>-->
 <li><a href="report_by_diagnosis.php">In-Patient Details (Diagnosis Search)</a>
 </ol>
 <li><b>Special Reports</b>
 <ol>
 <li><a href="report_pediatrics_ip.php">In-Patient Details (Admissions,Discharges,Deaths)-For SNCU</a>
 <li><a href="outcome_reports.php">Outcome Reports - Duration/Stay etc.,</a>
 <li><a href="audiology_reports.php">Audiology Reports </a>
 </ol>
 </td>
 </tr>
 </table>
 
 <!-- end right div content -->
 </div>
 <?php include '../footer.php'; ?>
  <!-- end main page content -->
</div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
