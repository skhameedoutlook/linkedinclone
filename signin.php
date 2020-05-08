<!DOCTYPE html>
<html>
	<head>
		<title>LinkedIn Clone</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/indexstyles.css">
	</head>
	<body>
        <h3>Welcome Back</h3>
        <?php
            session_start();
            if(isset($_POST["text_content"])) {
                // $_SESSION['uname'] = 'skhameed@outlook.com';
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
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                
                $addpostsuccess = 1;
                // $title = $_POST['title'];
                $text_content = $_POST['text_content'];
                $email = $email = $_SESSION['uname'];
                $sql = "INSERT INTO posts(text_content, user_email) values('$text_content', '$email')";
                // if(strlen($title) > 0) {
                if(strlen($text_content) > 0) {
                    if (!mysqli_query($conn, $sql)) {
                        $addpostsuccess = 4;
                    } 
                }
                else {
                    $addpostsuccess = 3;   
                }
                // }
                // else {
                    
                //     $addpostsuccess = 2;
                // } 
                
                if($addpostsuccess == 1) {
                    unset($_SESSION['error_message']);
                    $_SESSION['post_created'] = 'Post created successfully.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                else if($addpostsuccess == 2) {
                    $_SESSION['error_message'] = 'Please enter a valid title.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                else if($addpostsuccess == 3) {
                    
                    $_SESSION['error_message'] = 'Please enter the post content.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                else if($addpostsuccess == 4) {
                    $_SESSION['error_message'] = 'Unknown error occured please try again.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
            }
            else if(isset($_POST["email"])) {
                // $_SESSION['uname'] = 'skhameed@outlook.com';
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
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                $loginsuccess = 1;
                $email = $_POST["email"];
                $password = $_POST["password"];
                $sql = "select count(email) from usertable where email='$email'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_row($result);
                if($row[0] == "1") {
                    $sql = "select password from usertable where email='$email'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_row($result);
                    if($row[0] == $password) {
                        //section to be used later.
                    }
                    else {
                        $loginsuccess = 3;
                    }
                }
                else {
                    $loginsuccess = 2;
                }
                mysqli_close($conn);
                if($loginsuccess == 1) {
                    unset($_SESSION['error_message']);
                    $_SESSION['uname'] = $email;
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                else if($loginsuccess == 2) {
                    unset($_SESSION['uname']);
                    $_SESSION['error_message'] = 'Invalid email. Please try logging in with a registered email id.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                else if($loginsuccess == 3) {
                    unset($_SESSION['uname']);
                    $_SESSION['error_message'] = 'Invalid password. Please try logging in again.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
                else {
                    unset($_SESSION['uname']);
                    $_SESSION['error_message'] = 'Unknown error occured. Please try logging in again.';
                    echo "
                    <script>window.location.href='signin.php'</script>
                    ";
                }
            }
            if(isset($_SESSION['uname'])) {
                echo "Logged In: ". $_SESSION['uname'];
                if(isset($_SESSION['post_created'])) {
                    $v1 = $_SESSION['post_created'];
                    // unset($_SESSION['post_created']);
                    echo "<h4>$v1</h4>";
                }
                if(isset($_SESSION['error_message'])) {
                    echo $_SESSION['error_message'];
                    // unset($_SESSION['error_message']);
                }
                echo '
                <form action="signin.php" method="post">
                   
                    <textarea rows="4" cols="30" name="text_content"></textarea>
                    <input type="submit" value="Post" />
                </form>';
                
                echo '
                <form action="logout.php">
                    <input type="submit" value="Logout" />
                </form>
                ';
            }
            else {
                unset($_POST["email"]);
                if(isset($_SESSION['error_message'])) {
                    echo $_SESSION['error_message'];
                    // unset($_SESSION['error_message']);
                    // session_destroy();
                }
                echo '
                <form method="post" action="signin.php">
                    <input type="text" name="email" />
                    <input type="password" name="password"/>

                    <input type="submit" value="Sign In"/>
                </form>
                New to LinkedIn Clone? <a href="join.php">Join now</a>
                ';
            }
        ?>
	</body>
</html>