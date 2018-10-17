<?php
session_start();
?>

<html>
	Logged out successfully

<?php
session_unset();	
session_destroy();
header("Location: login.html");
?>
</html>