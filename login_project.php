<?php

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['username'])) {
    header("Location: count.php");
}


if (isset($_POST['submit'])) {
	// Define $myusername and $mypassword
	$username=$_POST['username'];
	$password=$_POST['password'];
 

	// To protect MySQL injection (more detail about MySQL injection)
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysqli_real_escape_string($conn, $username);
	$password = mysqli_real_escape_string($conn, $password);
	$sql="SELECT username, password FROM users where username='".$username."' and password='".$password."'";
	$result=mysqli_query($conn,$sql);
	$rows= mysqli_num_rows($result);
	if ($username == 'Admin' && $password =='admin')
	{
		$_SESSION['username']=$username;
		header("Location: admin.php");
	}
	else if ($rows == 1) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['username'] = $row['username'];
		header("Location: count.php");
	} else {
		echo "<script> alert('Uh-Oh! Incorrect Username or Password.') </script>";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="stylesheet.css">
	<link rel="stylesheet" href="navbar.css">

	<title>Login Form</title>
</head>
<body>
<nav>
      <div class="nav__logo"><a href="login_project.php"><img src="./logo.jpg" alt="" /></a></div>
      <ul>
        <li><a href="login_project.php">Home</a></li>
        <li><a href="">History</a></li>
      </ul>
    </nav>

	<div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" value="<?php echo $_POST['username']; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register_new.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>
