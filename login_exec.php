<?php
	//Start session
	session_start();
	
	//Include database connection details
 include("db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");		 
	
	$username = "$_POST[username]";
	$password = "$_POST[password]";
	
	//Create query
	$qry="SELECT * FROM users WHERE username='$username' AND password='$password'";
	$result=mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		if(mysql_num_rows($result) == 1) {
			//Login Successful
			session_regenerate_id();
			$user = mysql_fetch_assoc($result);
			$_SESSION['SESS_USER_ID'] = $user['user_id'];
			$_SESSION['SESS_USER_ID_TYPE'] = $user['user_type_id'];
            
			session_write_close();
			
			header("location:date_update.php?");
			
			exit();
		}else {
			//Login failed
			header("location: index.php?fail");
			exit();
		}
	}else {
		die("Query failed");
	}
?>
