<?php
session_start();

if(!isset($_SESSION["ses_username"]) || trim($_SESSION["ses_password"])==""){
	header("location: login.html");
	exit();
}
?>

<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php include 'connection.php';

$name = $_SESSION["ses_username"];
$bookId = $_GET["bookId"];
$sql = "INSERT INTO Shoppingcart (UserName, BookID) VALUES ('$name', '$bookId')";

if ($conn->query($sql) === TRUE) {
	$sql1 = "SELECT * FROM Shoppingcart WHERE UserName = '$name'";
	$result1 = mysqli_query($conn, $sql1);
	$books = array();
	while($row = mysqli_fetch_array($result1)){
		array_push($books, $row["BookID"]);
	}
	$books = join(',',$books);
	$sql2 = "SELECT * FROM book WHERE BookID IN ($books)";
	$result2 = mysqli_query($conn, $sql2);
	echo "<table class='table table-striped'><tr><td>Book Title</td><td>List Price</td></tr>";
	
	$totalPrice = 0;
	while($row = mysqli_fetch_array($result2)){
		echo "<tr><td>". $row["BookTitle"] ."</td><td>". $row["ListPrice"]."</td></tr>";
		$totalPrice = $totalPrice + $row["ListPrice"];
	}
	echo "<tr><td>Total</td><td>$totalPrice</td></tr></table>";
	
	echo "<a href ='books.php'>Continue Shopping</a>";
	
} else {  
	echo '<script language="javascript">';
	echo 'alert("The book is already in the cart");';
	echo 'window.location.href = "books.php";';
	echo '</script>';
	
}
?>