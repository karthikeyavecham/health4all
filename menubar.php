<!-- Page for the Menubar -->
<?php session_start();?>
<div id="header">
<?php 
if(isset($_SESSION['SESS_USER_ID']))
{
echo "<div id=\"loggedin\" >";
//user details 
 echo "Logged in as : <b style=\"color:#385413;\">";
include("db_connect.php");

$query = "SELECT *
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) { echo $row['username'];}

echo " </b>&nbsp;&nbsp";
//end of user details

echo "<a href=\"logout.php\">Logout</a>";
echo "<br><br><br>";

//hospital details
echo "<div>";
$query_hosp = "SELECT * FROM hospitals LIMIT 1";
$row_hosp = mysql_fetch_assoc(mysql_query($query_hosp));
echo "<b><font face=\"sans-serif\">".$row_hosp['hospital']."</font></b>";
echo "</div>";
echo "</div>";

}
else if (($thispage == "index")||($thispage == "help")){}
else
{
header("location: index.php");
exit();
}
?>

</div>
<?php
if(isset($_SESSION['SESS_USER_ID']))
{
include("db_connect.php");

$query = "SELECT * FROM users WHERE user_id=".$_SESSION['SESS_USER_ID'];
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)){
$user_type=$row['user_type_id'];
if($user_type=='1'){
echo "<ul class=\"menubar\">";
 ?>
 <li <?php if ($thispage == "index") echo " id=\"selected\"";?>><a href="index.php">Home</a></li>
 <li <?php if ($thispage == "outpatient_first" || $thispage == "outpatient_repeat") echo " id=\"selected\"";?>><a>OP Register</a>
 <ul><li><a href="registration_op_first.php">First Visit</a></li><li><a href="registration_op_repeat.php">Repeat Visit</a></li></ul>
 </li>
 <li <?php if ($thispage == "view") echo " id=\"selected\"";?>><a href="view.php">View</a></li>
 <li <?php if ($thispage == "reports") echo " id=\"selected\"";?>><a href="reports/reports.php">Statistics</a></li>
 <li <?php if ($thispage == "help") echo " id=\"selected\"";?>><a href="help.php">Help</a></li>
 <?php
 echo "</ul>";
 }
 else if($user_type=='9'){
 echo "<ul class=\"menubar\">";
 ?>
 <li <?php if ($thispage == "index") echo " id=\"selected\"";?>><a href="index.php">Home</a></li>
 <li <?php if ($thispage == "outpatient_first" || $thispage == "outpatient_repeat") echo " id=\"selected\"";?>><a>OP Register</a>
 <ul><li <?php if ($thispage == "outpatient_first") echo " id=\"selected\"";?>><a href="registration_op_first.php">First Visit</a></li><li <?php if ($thispage == "outpatient_repeat") echo " id=\"selected\"";?>><a href="registration_op_repeat.php">Repeat Visit</a></li></ul>
 </li>
 <li <?php if ($thispage == "registration_ip") echo " id=\"selected\"";?>><a href="registration_ip.php">IP Register</a></li>
 <li <?php if ($thispage == "registration_ip_trans") echo " id=\"selected\"";?>><a href="registration_ip_trans.php" >IP Transfer</a></li>
 <li <?php if ($thispage == "update" || $thispage == "update_icd10") echo " id=\"selected\"";?>><a>Update</a>
 <ul><li <?php if ($thispage == "update") echo " id=\"selected\"";?>><a href="update.php">Patient Update</a></li><li <?php if ($thispage == "update_icd10") echo " id=\"selected\"";?>><a href="icd_10/icd_update.php">ICD 10 Update</a></li></ul>
 </li> 
 <li <?php if ($thispage == "view") echo " id=\"selected\"";?>><a href="view.php">View</a></li>
 <li <?php if ($thispage == "reports") echo " id=\"selected\"";?>><a href="reports/reports.php">Statistics</a></li>
 <li><a>Equipment</a>
<ul><li><a href="equipments/equipment_reg.php">Register Equipment</a></li>
 <li><a href="equipments/report_detail_equip.php">Updates & Issue Register</a></li>
 <li><a href="equipments/equip_statistics.php">Equipment statistics</a></li></ul></li>
 <li <?php if ($thispage == "help") echo " id=\"selected\"";?>><a href="help.php">Help</a></li>
 <li><a>Admin Panel</a>
 <ul><li><a href="admin_panel.php">Search Records</a></li>
 <li><a href="deduplication.php">Deduplication</a></li>
 <li><a href="manage_users.php">Manage Users</a></li></ul></li>
 <?php 
 echo "</ul>";
 }
 else{
 echo "<ul class=\"menubar\">";
 ?>
 <li <?php if ($thispage == "index") echo " id=\"selected\"";?>><a href="index.php">Home</a></li>
 <li <?php if ($thispage == "outpatient_first" || $thispage == "outpatient_repeat") echo " id=\"selected\"";?>><a>OP Register</a>
 <ul><li <?php if ($thispage == "outpatient_first") echo " id=\"selected\"";?>><a href="registration_op_first.php">First Visit</a></li><li <?php if ($thispage == "outpatient_repeat") echo " id=\"selected\"";?>><a href="registration_op_repeat.php">Repeat Visit</a></li></ul>
 </li>
 <li <?php if ($thispage == "registration_ip") echo " id=\"selected\"";?>><a href="registration_ip.php">IP Register</a></li>
 <li <?php if ($thispage == "registration_ip_trans") echo " id=\"selected\"";?>><a href="registration_ip_trans.php" >IP Transfer</a></li>
 <li <?php if ($thispage == "update" || $thispage == "update_icd10") echo " id=\"selected\"";?>><a>Update</a>
 <ul><li <?php if ($thispage == "update") echo " id=\"selected\"";?>><a href="update.php">Patient Update</a></li><li <?php if ($thispage == "update_icd10") echo " id=\"selected\"";?>><a href="icd_10/icd_update.php">ICD 10 Update</a></li></ul>
 </li> 
 <li <?php if ($thispage == "view") echo " id=\"selected\"";?>><a href="view.php">View</a></li>
 <li <?php if ($thispage == "reports") echo " id=\"selected\"";?>><a href="reports/reports.php">Statistics</a></li>
 <li><a>Equipment</a>
<ul><li><a href="equipments/equipment_reg.php">Register Equipment</a></li>
 <li><a href="equipments/report_detail_equip.php">Updates & Issue Register</a></li>
 <li><a href="equipments/equip_statistics.php">Equipment statistics</a></li></ul></li>
 <li <?php if ($thispage == "help") echo " id=\"selected\"";?>><a href="help.php">Help</a></li>
<?php 
echo "</ul>";
}}}
else {
 echo "<ul class=\"menubar\">";
 ?>
 <li <?php if ($thispage == "index") echo " id=\"selected\"";?>><a href="index.php">Home</a></li>
 <li <?php if ($thispage == "help") echo " id=\"selected\"";?>><a href="help.php">Help</a></li>
 <?php
 echo "</ul>";
 }?>
<div class="bottombar"></div>
