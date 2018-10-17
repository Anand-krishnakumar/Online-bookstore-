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

<?php
$search = $_GET["search"];
?>


<form action="books.php" method="GET">
<input type="text" name="search" value="<?php echo $search ?>">
<input type="submit" value="Search">
</form>
<p style="text-align: right; margin-right: 100px"><a href ="logout.php">Logout</a></p>
<?php

$user = 'root';
$password = 'root';
$db = 'bookstore';
$host = 'localhost';
$port = 8889;

$conn = mysqli_connect(
   $host, 
   $user, 
   $password, 
   $db,
   $port
);


if (!$conn){

  echo "Connection failed!";
  exit;

}

$sql = "SELECT * FROM book";

if ($search){
	$sql = " WHERE BookTitle LIKE '%$search%' ";

}


$result = mysqli_query($conn, $sql);

echo "<table class='table table-striped'><tr><td>Book Title</td><td>List Price</td><td><td></tr>";

while($row = mysqli_fetch_array($result)){

echo "<tr><td>". $row["BookTitle"] ."</td><td>". $row["ListPrice"]."</td><td><a href='cart.php?bookId=" .$row["BookID"]. "'>Add to Cart</a></td></tr>";

}

echo "</table>";
mysqli_close();

?>

</body>
</html>