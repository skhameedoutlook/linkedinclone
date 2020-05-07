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
            $regsuccess = 1;
            if($_POST['email'] == "shameedoffice@gmail.com") {
                $regsuccess = 2;
            }
            if($regsuccess == 1) {
                session_destroy();
                echo "Registration Successful. Login <a href='signin.php'>Here</a>";
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