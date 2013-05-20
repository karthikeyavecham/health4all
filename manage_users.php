<?php $thispage = "manage_users"; ?>
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
 
 <!-- begin right div content -->
 <div id="right">
	<div style="float:left;width:45%;margin:30px 0 0 10px;">
	<fieldset><legend><h3>Create New User</h3></legend>
	<form method="post" name="create_user" action="manage_users.php">
	<table>
	<tr>
	<td>Username</td>
	<td><input type="text" name="username" size=15></td>
	</tr>
	<tr>
	<td>Password</td>
	<td><input type="password" name="password" size=15></td>
	</tr>
	<tr>
	<td>User Type</td>
	<td><select name="usertype" style="max-width:190px;">
					<option selected="selected" disabled>--Select--</option>
					<?php
					include("db_connect.php");
					mysql_connect("$dbhost","$dbuser","$dbpass");
					mysql_select_db("$dbdatabase");
					$sql=mysql_query("select * from user_type");
					while($row=mysql_fetch_array($sql))
					{
						echo '<option value="'.$row['user_type_id'].'">'.$row['user_type'].'</option>';
 					}
					?>	
				</select></td>
	</tr>
<!--	<tr>
	<td>Email </td>
	<td><input type="text" name="email" /></td>
	</tr>-->
	<tr>
	<td colspan="2" align="center"><input type="submit" name="createuser_submit"  value="Submit"></td>
	</tr></table>
	</form>
 </fieldset>
 </div>
 <div style="float:right;width:45%;margin:30px 0 0 30px;">
	<fieldset><legend><h3>Search users</h3></legend>
	<form name="search_users" method="POST" action="manage_users.php">
	<table style="margin-top:3%;">
<form name="myform" method="post" action="manage_users.php">
<tr>
	<td><select name="search_by" value="$_POST['search_by']">
		<option value="username">Username</option>
		<option value="user_id">User Id</option>
		<option value="user_type_id">User Type</option>
	</select></td>
	<td><input type="text" name="search_text"></td>
	<td><input type="submit" name="search" value="Search" ></td>
</tr>
</form>
</table>
 </div>	
 <!-- end right div content -->
 </div>
<!---<?php 
if (isset($_POST['search'])) 
{
	//connect to database
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");
	if(($_POST['search_by']=="username"))
	{
		$viewquery = "SELECT * 
			FROM users
			JOIN user_type ON users.user_type_id=user_type.user_type_id
			WHERE ($_POST[search_by] LIKE '%$_POST[search_text]%')";
	}
	else{
		$viewquery = "SELECT * 
			FROM users
			JOIN user_type ON users.user_type_id=user_type.user_type_id
			WHERE ($_POST[search_by]='$_POST[search_text]')";
	}
	$result = mysql_query($viewquery);
	echo "<div style=\"width:100%;margin:15px 0 0 0;float:left;\">";
	echo"<h3>Select user: </h3>";
	echo "<table id=\"table-search\">";
	echo "<thead>";
	echo "<th>Username</th>";
	echo "<th>User Type</th>";
	echo "<td></td>";
	echo "<td></td>";
	echo "</thead>";
	echo "<tbody>";
	while ($record = mysql_fetch_array($result))
	{
		echo "<tr>";
		echo "<form action=manage_users.php method=post>";
		echo "<td><input type=\"text\" name=\"username\" value=\"" . $record['username'] . "\"></td>";
		echo '<td><select name="user_type" id="user_type" style="max-width:190px;"></td>';
		echo "<td>";
		echo "<input type=submit name=ok value=Update>";
		echo "</form>";
		echo "</td>";
		echo "<td><form action=manage_users.php method=post><input type=\"hidden\" name=\"search_pid\" value=\"" . $record['user_id'] . "\"> <input type=submit name=delete_user value=X ></td>";
		echo "</tr>";
	 }
	echo "</tbody>";
	echo "</table>";
	echo "</div>";
}
?>
<?php
if(isset($_POST['delete_user']))
{
	$query="DELETE FROM users WHERE user_id='$_POST[search_pid]'";
	$result=mysql_query($query);
} 
?>
<?php
if (isset($_POST['ok']))
{
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");		 
	$query="UPDATE users set username='$_POST[username]',user_type_id='$_POST[user_type]' WHERE user_id='$_POST[user_id]'";
	if($result=mysql_query($query))
	{
		echo "<h2>Update Scuucessful!</h2>";
		echo "<table>";
		echo "<tr><td>";
		echo "Username : </td>";
		echo "<td>"; echo $_POST[username]; echo "</td></tr>"; echo "<tr><td>User Type:</td>"; echo "<td>"; echo $_POST[user_type]; echo "</td></tr></table>";
	}
}?>-->
<?php
if(isset($_POST['createuser_submit']))
{
	//connect to database
	include("db_connect.php");
	mysql_connect("$dbhost","$dbuser","$dbpass");
	mysql_select_db("$dbdatabase");
	$query="INSERT INTO users(username,password,user_type_id) VALUES ('$_POST[username]','$_POST[password]','$_POST[usertype]')";
	$result=mysql_query($query);
	$select="SELECT * FROM users JOIN user_type ON users.user_type_id=user_type.user_type_id WHERE username='$_POST[username]'";	
	$selresult=mysql_query($select);
	while($record=mysql_fetch_array($selresult)){

	echo "<table id=table-search width=65% style=\"margin:3%\">
	<th>User Registered :</th>
	<tr>
	<td> Username : </td>
	<td>".$_POST['username']."</td>
	</tr>
	<tr>
	<td> User Type : </td>
	<td>".$record['user_type']."</td></tr></table>";
	}
}
?>

 <?php include 'footer.php'; ?>
  <!-- end main page content -->
</div>
 <!-- end wrap contents of page  -->
 </div>
 </body>
 </html>
 
