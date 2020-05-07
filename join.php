<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up|LinkedIn Clone</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/indexstyles.css">
	</head>
	<body>
    <?php
        session_start();
        if(isset($_POST['email'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "linkedinclone";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $database);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                $_SESSION['error_message'] = 'DB error occured. Please try again.';
                echo "
                <script>window.location.href='join.php'</script>
                ";
            }
            // echo "Connected successfully";
            $email = "";
            $password = "";
            $regsuccess = 1;
            if(strlen($_POST['email']) <= 254 && strlen($_POST['email']) >= 3) {
                $email = $_POST['email'];
                if(strlen($_POST['password']) <= 254 && strlen($_POST['password']) >= 3) {
                    $password = $_POST['password'];
                    $sql = "SELECT COUNT(email) from usertable where email='$email'";
                    if ($result = mysqli_query($conn, $sql)) {
                        $row = mysqli_fetch_row($result);
                        // echo "<script>alert('$row[0]')</script>";
                        if($row[0] == "0") {
                            echo "<script>alert('$row[0]'+'$email')</script>";
                            $sql = "INSERT INTO usertable(`email`, `password`) VALUES ('$email', '$password')";
                            if (!mysqli_query($conn, $sql)) {
                                $regsuccess = 5;
                            }   
                        }
                        else {
                            $regsuccess = 4;
                        }
                    }
                    else {
                        echo "<script>alert('unknown')</script>";
                    }
                    mysqli_close($conn);
                }
                else {
                    $regsuccess = 3;
                }
            }
            else {
                $regsuccess = 2;
            }
            if($regsuccess == 1) {
                session_destroy();
                echo "Registration Successful. Login <a href='signin.php'>Here</a>";
            }
            else if($regsuccess == 2) {
                $_SESSION['error_message'] = 'Username should be 3-254 characters in length. Please register again.';
                echo "
                <script>window.location.href='join.php'</script>
                ";
            }
            else if($regsuccess == 3) {
                $_SESSION['error_message'] = 'Password should be 3-254 characters in length. Please register again.';
                echo "
                <script>window.location.href='join.php'</script>
                ";
            }
            else if($regsuccess == 4) {
                $_SESSION['error_message'] = 'Email already taken. Please try a new email.';
                echo "
                <script>window.location.href='join.php'</script>
                ";
            }
            else if($regsuccess == 5) {
                $_SESSION['error_message'] = 'Could not create user. Please try again.';
                echo "
                <script>window.location.href='join.php'</script>
                ";
            }
            else {
                $_SESSION['error_message'] = 'Registration unsuccessful. Please register again.';
                echo "
                <script>window.location.href='join.php'</script>
                ";
            }
        }
        else {
            if(isset($_SESSION['error_message'])) {
                echo $_SESSION['error_message'];
                session_destroy();
            }
            echo '
            <form method="post" action="join.php">
                <input type="text" name="email"/>
                <input type="password" name="password"/>
                <input type="submit" value="Agree & Join"/>
            </form>
            Already on LinkedIn Clone? <a href="signin.php">Sign in</a>
            ';
        }
        
    ?>
		
	</body>
</html>