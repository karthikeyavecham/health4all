<!-- Page for the Menubar -->
<?php session_start();?>
<div id="header">
<?php 
if(isset($_SESSION['SESS_USER_ID']))
{
echo "<div id=\"loggedin\" >";
//user details 
 echo "Logged in as : <b style=\"color:#385413;\">";
include("../db_connect.php");

$query = "SELECT username
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) { echo $row['username'];}

echo " </b>&nbsp;&nbsp";
//end of user details

echo "<a href=\"../logout.php\">Logout</a>";
echo "<br><br><br>";

//hospital details
echo "<div>";
$query_hosp = "SELECT * FROM hospitals LIMIT 1";
$row_hosp = mysql_fetch_assoc(mysql_query($query_hosp));
echo "<b><font face=\"sans-serif\">".$row_hosp['hospital']."</font></b>";
echo "</div>";
echo "</div>";
}
else
{
header("location: ../index.php");
exit();
}
?>
</div>
<?php
if(isset($_SESSION['SESS_USER_ID']))
{
include("../db_connect.php");

$query = "SELECT * FROM users WHERE user_id=".$_SESSION['SESS_USER_ID'];
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$result = mysql_query($query);
while ($row = mysql_fetch_assoc($result)){
$user_type=$row['user_type_id'];
if($user_type=='1'){
echo "<ul class=\"menubar\">";
 ?>
 <li><a href="../index.php">Home</a></li>
 <li><a>OP Register</a>
 <ul><li><a href="../registration_op_first.php">First Visit</a></li><li><a href="../registration_op_repeat.php">Repeat Visit</a></li></ul></li>
 <li><a href="../view.php">View</a></li>
 <li><a href="../reports/reports.php">Statistics</a></li>
 <li><a href="../help.php">Help</a></li>
 <?php
 echo "</ul>";
 }
 else if($user_type=='9'){
 ?>
 <ul class="menubar">
 <li><a href="../index.php" >Home</a></li>
 <li><a>OP Register</a>
 <ul><li><a href="../registration_op_first.php">First Visit</a></li><li><a href="../registration_op_repeat.php">Repeat Visit</a></li></ul></li>
 <li><a href="../registration_ip.php">IP Register</a></li>
 <li><a href="../registration_ip_trans.php" >IP Transfer</a></li>
 <li><a>Update</a>
 <ul><li><a href="../update.php">Patient Update</a></li><li><a href="../icd_10/icd_update.php">ICD 10 Update</a></li></ul></li>
 <li><a href="../view.php">View</a></li>
 <li><a href="../reports/reports.php">Statistics</a></li>
 <li <?php if ($thispage == "equipment") echo " id=\"selected\"";?>><a>Equipment</a>
 <ul><li><a href="equipment_reg.php">Register Equipment</a></li>
 <li><a href="report_detail_equip.php">Updates & Issue Register</a></li>
 <li><a href="equip_statistics.php">Equipment statistics</a></li></ul></li>
 <li><a href="../help.php">Help</a></li>
 <li><a>Admin Panel</a>
 <ul><li><a href="../admin_panel.php">Search Records</a></li>
 <li><a href="../deduplication.php">Deduplication</a></li>
 <li><a href="../manage_users.php">Manage Users</a></li></ul></li>
 <?php
 echo "</ul>";
}
else {
?>
 <ul class="menubar">
 <li><a href="../index.php" >Home</a></li>
 <li><a>OP Register</a>
 <ul><li><a href="../registration_op_first.php">First Visit</a></li><li><a href="../registration_op_repeat.php">Repeat Visit</a></li></ul></li>
 <li><a href="../registration_ip.php">IP Register</a></li>
 <li><a href="../registration_ip_trans.php" >IP Transfer</a></li>
 <li><a>Update</a>
 <ul><li><a href="../update.php">Patient Update</a></li><li><a href="../icd_10/icd_update.php">ICD 10 Update</a></li></ul></li>
 <li><a href="../view.php">View</a></li>
 <li><a href="../reports/reports.php">Statistics</a></li>
 <li <?php if ($thispage == "equipment") echo " id=\"selected\"";?>><a>Equipment</a>
 <ul><li><a href="equipment_reg.php">Register Equipment</a></li>
 <li><a href="report_detail_equip.php">Updates & Issue Register</a></li>
 <li><a href="equip_statistics.php">Equipment statistics</a></li></ul></li>
 <li><a href="../help.php">Help</a></li>
 <?php
 echo "</ul>";
}}}
?>
<div class="bottombar"></div>
