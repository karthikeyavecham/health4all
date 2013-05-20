<?php $thispage = "index"; ?>
<!DOCTYPE html>
 <html>

 <head>
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
 <h4 align="center">Welcome to</h4>
 <h2 align="center">Health4All</h2>
 <h3 align="center">a Free and Open Source Health Information Application</h3>
 <h4 align="center">supported by<br /><a href="http://yousee.in/"><img src="images/youseelogo.png" alt="YouSee" width=10% height=10%></img></a></h4>

 
  <!-- Login Form starts here-->
 <div>
<?php
	//Start session
	//session_start();
if(!isset($_SESSION['SESS_USER_ID'])) {
include 'login_form.php' ;
if(isset($_GET['fail'])){
?>
<h4 style="color:red;" align="center">
Login Failed!</br>
Please check your username and password</h4>
<?php
}
} else {

include("db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
?>
<h3 align="center">Successfully Logged In as : <?php


// this section generates query for user info
$query = "SELECT *
          FROM users
          WHERE user_id=".$_SESSION['SESS_USER_ID'];
$result = mysql_query($query);

//Display user info
while ($row = mysql_fetch_assoc($result)) { 
echo "<a style=\"color:red;\">";
echo $row['username'];
echo "</a></h3>";
echo "<h4 align=\"center\"> Your Last Login On <a style=\"color:red;\">"; if($row['past_login_date']!='0000-00-00'){echo date("d M Y", strtotime($row['past_login_date']));} echo " - "; if($row['past_login_time']!='00:00:00'){echo date("g:ia", strtotime($row['past_login_time']));} echo "</a></h4>";
}
}?>
 </div>
<?php include 'footer.php'; ?>
 <!-- end main page content -->
 </div>

 <!-- end wrap contents of page  -->
 </body>
 </html>













 
 
 
 
 
 
 
 
 
 
 
 
 
