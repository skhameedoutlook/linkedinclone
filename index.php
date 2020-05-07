<?php
session_start();
?>

<?php
$_SESSION["v1"] = "value1";
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "linkedinclone";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>

<!DOCTYPE html>
<html>
	<head>
		<title>LinkedIn Clone</title>
		<link rel="stylesheet" type="text/css" href="styles/indexstyles.css">
	</head>
	<body>
		
	</body>
</html>

