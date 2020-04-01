<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 12, 2020
    Description: Login PHP

----------------->

<?php



if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$errors = "";
	$password_err = "";
	if(isset($_POST['username']))
	{
		// The DB connection
		require 'connect.php';

		try
		{
			$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
			$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
			$username = trim($_POST['username']);
	    	$password = trim($_POST['password']);

	    	//$hash = password_hash($password, PASSWORD_DEFAULT);

	    	//Query for all the info you need based on username and password
	    	$query = "SELECT id, admin, username, password, firstname, lastname, streetaddy, city, province, email, phone FROM user WHERE username = :username";

	    	//$statement = $db->prepare($query);
	    	//$statement->bindValue(':newUser', $username);
	    	//$statement->bindValue(':password', $password);
	    	//$statement->execute();
	    	

	    	// if(empty($row))
	    	// {
	    	// 	$errors = "The username or password are wrong.";
	    	// }
	    	if($statement = $db->prepare($query))
	    	{
	    		$statement->bindValue(':username', $username);
	    		//$statement->bindValue(':password', $password);
		    	if($statement->execute())
		    	{
		    		if($statement->rowCount() == 1)
		    		{
		    			echo "in rowCount() == 1";
			    		if($row = $statement->fetch())
				    	{
				    		$hash = $row['password'];


				    		echo $password;

					    	if(password_verify($password, $hash))
					    	{
					    		session_start();
					    	    echo "IN HERE!";
					    		//Set the Session variables with the info you need.
					    		$_SESSION['id'] = $row['id'];
					    		$_SESSION['admin'] = $row['admin'];
					    		$_SESSION['username'] = $row['username'];
					    		$_SESSION['firstname'] = $row['firstname'];
					    		$_SESSION['lastname'] = $row['lastname'];
					    		$_SESSION['streetaddy'] = $row['streetaddy'];
					    		$_SESSION['city'] = $row['city'];
					    		$_SESSION['province'] = $row['province'];
					    		$_SESSION['email'] = $row['email'];
					    		$_SESSION['phone'] = $row['phone'];
					    		header("location: userinfo.php");
					    	}else{
	                            // Display an error message if password is not valid
	                            $password_err = "The password you entered was not valid.";
	                        }
		   			    }
					}
				}
			}
		}
		catch(PDOException $ex)
		{
			print "Error: " . $ex->getMessage();
			die(); // Force execution to stop on errors.
		}
	}
}

if(isset($_POST["command"]))
{
	if($_POST["command"] === 'Sign Up')
	{
		echo "SIGN UP!";
		$username = $_POST['username'];
		$password = $_POST['password'];
		echo "user: " . $username . " pass : " . $password;

		header("Location: create.php");
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
		<?php if(!isset($_SESSION['id'])): ?>
			<h1>Welcome to CF Computing : Login</h1>
		<?php else: ?>
			<h1>Welcome to CF Computing : Login<br></h1>
			<h2>User: <?= $_SESSION['username'] ?></h2>
		<?php endif ?>
	</header>
	<nav id="banner">
		<ul>
			<li><a href = "index.php">Home</a></li>
			<?php if(!isset($_SESSION['id'])): ?>
				<li><a href = "login.php">Login</a></li>
			<?php else: ?>
				<li><a href = "userinfo.php">User Info</a></li>
			<?php endif ?>
			<li><a href = "services.php">Services</a></li>
			<li><a href = "contact.php">Contact Us</a></li>
			<li><a href = "about.php">About Us</a></li>
		</ul>
	</nav>
	<div id="content">
 		<?php if(!empty($errors)): ?>
 			<?= $errors ?>
 		<?php endif ?>
 		<?php if(!isset($_SESSION['id'])): ?>
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
		<?php endif ?>
  	</div>

	<div class="mylogo">
		<!-- This is MY personal LOGO from my real business I ran so there is no credit for the image except to myself :) -->
	</div>

	<footer>
		<nav id = "footerBanner">
			<ul>
			<li><a href = "index.php">Home</a></li>
			<?php if(!isset($_SESSION['id'])): ?>
				<li><a href = "login.php">Login</a></li>
			<?php else: ?>
				<li><a href = "userinfo.php">User Info</a></li>
			<?php endif ?>
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