<?php
	
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password))
	{
		header("Location: login.html");
		exit();
	}
	else
	{
		$success = false;
		DEFINE('DB_USERNAME', 'root');
		DEFINE('DB_PASSWORD', 'root');
		DEFINE('DB_HOST', 'localhost:8889');
	 	DEFINE('DB_DATABASE', 'bookstore');

	 	//$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	 	$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	 	if (mysqli_connect_error()) 
	 	{
	  		die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
	 	}
	 	else
	 	{
	 		$sql = "SELECT `username`, `password` FROM `user` WHERE `username` = '".$username."' AND `password` = '".$password."'";
		 	$result = mysqli_query($con,$sql);
		 	
		 	while($row = mysqli_fetch_array($result)) 
			{
						
		        		$success = true;
		    }
			if($success == true) 
		    		{
		    			$_SESSION['ses_username'] = $username;
						$_SESSION['ses_password'] = $password;
						header("Location: books.php");
						session_write_close();
		  				exit();
		        
		    		} 
		    		else
		    		{
		    			header("Location: login.html");
						exit();
		    		}   
	 	}

	 	mysqli_close($con);
	
	}
	
?>