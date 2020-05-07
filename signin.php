

<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up|LinkedIn Clone</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/indexstyles.css">
	</head>
	<body>
        <h3>Welcome Back</h3>
        <?php
            session_start();
            if(isset($_POST["email"])) {
                $_SESSION['uname'] = 'skhameed@outlook.com';
            }
            if(isset($_SESSION['uname'])) {
                echo "Logged In: ". $_SESSION['uname'];
                echo "
                <form action='logout.php'>
                    <input type='submit' value='Logout' />
                </form>
                ";
            }
            else {
                unset($_POST["email"]);
                echo "
                <form method='post'>
                    <input type='text' name='email' />
                    <input type='password' name='password'/>

                    <input type='submit' value='Sign In'/>
                </form>
                New to LinkedIn? <a href='join.php'>Join now</a>
                ";
            }
        ?>
        New to LinkedIn? <a href="join.php">Join now</a>
	</body>
</html>