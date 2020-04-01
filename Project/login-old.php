<!-------f--------

CRUD project
Name: Chris Feasby
Date: March 12, 2020
Description: Login PHP

----------------->

<?php

$errors="";

if(isset($_POST['username'])){
	//The DB connection
	require 'connect.php';

	try {

		//2. Clear what you passed from the form.
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		//Query for all the info you need based on username and password.
		$query = "SELECT id, username, address, phone FROM user WHERE username = :newUser AND password = :newPass";
		$statement = $db->prepare($query);
		$statement->bindValue(':newUser', $username);
		$statement->bindValue(':newPass', $password);
		$statement->execute();
		$row = $statement->fetch();

		if(empty($row)){
			$errors = "The username or password are wrong.";
		} else {
			//Set Session variables with the info you need.
			$_SESSION['id'] = $row['id'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['address'] = $row['address'];
			$_SESSION['phone'] = $row['phone'];


		}
	} catch (PDOException $ex) {
		print "Error: " . $e->getMessage();
		die(); // Force execution to stop on errors.
	}
}


if(isset($_POST['username']) && $_POST['command'] === 'Sign In')
{
	// require 'authenticate.php';
	$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$_POST['id'] = $id;
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	if(!empty($username) && !empty($password))
	{
		echo "INSIDE !empty";
		// $query = "SELECT id FROM user WHERE 'username' = ':username'
		// 					AND 'password' = ':password' AND 'id' = ':id'";
		$query = "SELECT id FROM user WHERE id = 1";
		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':password', $password);
		//$statement->execute();
		$statement->fetch();
		// $statement->execute(array(':id' => $id, ':username' => $username, ':password' => $password));
		$row = $statement->fetch();
		$statement->execute();

	}
	// try {
	//     $db = new PDO(DB_DSN, DB_USER, DB_PASS);
	// } catch (PDOException $e) {
	//     print "Error: " . $e->getMessage();
	//     die(); // Force execution to stop on errors.
	// }


	echo $username;
	if ($username == "")
	{
		$login_error_message = 'Username field is required!';
	}
	else if ($password == "")
	{
		$login_error_message = 'Password field is required!';
	}
	else
	{
		$id = Login($username, $password); // check user login
		if($id > 0)
		{
			$_SESSION['id'] = $id; // Set Session
			echo "IN if($id > 0)";
			//header("Location: signup.php");
		}
		else
		{
			$login_error_message = 'Invalid login details!';
		}
	}



}

//mysql_insert_id ([ resource $link_identifier = NULL ] ) : int;
//echo "Id: {$row['id']}";


function Login($username, $password)
{
	try
	{
		echo "INSIDE Login";
		try {
			$db = new PDO(DB_DSN, DB_USER, DB_PASS);
			echo 'connected (Login)!';
		} catch (PDOException $e) {
			print "Error: " . $e->getMessage();
			die(); // Force execution to stop on errors.
		}

		$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$query = "SELECT id, username, password FROM user WHERE id = 1";
		// $query = "SELECT 'id' FROM 'user' WHERE ('username'=':username') AND ('password'=':password')";
		$statement = $db->prepare($query);
		$statement->bindValue("id", $id);
		$statement->bindParam("username", $username, PDO::PARAM_STR);
		$statement->bindParam("password", $password, PDO::PARAM_STR);
		//$enc_password = hash('sha256', $password);
		//$query->bindParam("password", $enc_password, PDO::PARAM_STR);
		//$statement->fetch(PDO::FETCH_OBJ);

		$statement->execute();
		$row = $statement->fetchAll();
		echo "rowCount with id 1: " . $statement->rowCount();
		//echo $row['id'];
		$id = $_POST['id'];
		$username = $_POST['username'];

		if ($statement->rowCount() > 0)
		{
			$result = $statement->fetch(PDO::FETCH_OBJ);
			return $db->lastInsertId();
		}
		echo $statement->rowCount() . " " . $db->lastInsertId();;
		//isUsername($username);
	} catch (PDOException $e) {
		exit($e->getMessage());
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="cfstyles.css" />

	<title>CF Computing</title>
</head>

<body>
	<header>
		<h1>Welcome to CF Computing : Login</h1>
	</header>
	<nav id="banner">
		<ul>
			<li><a href = "index.php">Home</a></li>
			<li><a href = "login.php">Login</a></li>
			<li><a href = "services.php">Services</a></li>
			<li><a href = "contact.php">Contact Us</a></li>
			<li><a href = "about.php">About Us</a></li>
		</ul>
	</nav>
	<div id="content">
		<?php if (!empty($errors)): ?>
			<?= $errors ?>
		<?php endif; ?>
		<?php if(!$_SESSION['id']): ?>
			<form action="login.php" method="post">
				<div id="content">
					<div>
						<label for="inputUsername">Username</label>
						<input type="text" class="form-control" name="username" id="inputUsername">
					</div>
					<div>
						<label for="inputPassword">Password</label>
						<input type="password" class="form-control" name="password" id="inputPassword">
					</div>

					<input type="submit" name="command" value="Sign Up" />
					<input type="submit" name="command" value="Sign In" />

				</form>
			<?php else: ?>
				<div class="">
					<?= "ID: " . $_SESSION['id']  ?><br>
					<?= "Username: " . $_SESSION['username'] ?><br>
					<?= "Address: " . $_SESSION['address'] ?><br>
					<?= "Phone: " . $_SESSION['phone'] ?><br>
				</div>
			<?php endif; ?>
		</div>

		<div class="mylogo">
			<!-- This is MY personal LOGO from my real business I ran so there is no credit for the image except to myself :) -->
		</div>

		<footer>
			<nav id = "footerBanner">
				<ul>
					<li><a href = "index.php">Home</a></li>
					<li><a href = "login.php">Login</a></li>
					<li><a href = "services.php">Services</a></li>
					<li><a href = "contact.php">Contact Us</a></li>
					<li><a href = "about.php">About Us</a></li>
				</ul>
				<p>CF Computing</p>
				<img src = "keyboard.jpg" alt = "keyboard" id ="keyboard" />
			</nav>
			<!-- image credit(both images) : https://www.google.com/search?q=computer+images&rlz=1C1GCEA_enCA831CA831&tbm=isch&sxsrf=ACYBGNTVhWyi6umZY0WZmyEGXQzpWGoeVg:1573689224689&source=lnt&tbs=sur:fc&sa=X&ved=0ahUKEwiqr-WZsejlAhWV4J4KHa6FDroQpwUIJA&biw=1920&bih=969&dpr=1 -->
			<img src = "footerimage.jpg" alt = "computer" id ="pic" />

		</footer>
		<script src="main.js"></script>
	</body>
	</html>
