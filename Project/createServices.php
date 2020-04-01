<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 23, 2020
    Description: CreateServices PHP

----------------->

<?php

	session_start();
	if(isset($_POST['command']))
	{
		if($_POST['name'] === '' ||
		   $_POST['description'] === '' ||
		   $_POST['price'] === '')
		{
			$isTrue = false;
		}
		else
		{
			$isTrue = true;
		}

		if($_POST['command'] === 'Add Service' && $isTrue)
		{
			require 'connect.php';
			//Do the insert query
			$serviceName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			$serviceDescription = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
			$servicePrice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

			$query = "INSERT INTO services (name, description, price)
					  VALUES (:name, :description, :price)";

			$statement = $db->prepare($query);
			$statement->bindValue(':name', $serviceName);;
			$statement->bindValue(':description', $serviceDescription);
			$statement->bindValue(':price', $servicePrice);
			$statement->execute();

			$insert_id = $db->lastInsertId();
			
			header("Location: services.php");
			
			
		}
	}
	else
	{

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
			<h1>Welcome to CF Computing : Create Services</h1>
		<?php else: ?>
			<h1>Welcome to CF Computing : Create Services<br></h1>
			<form action="index.php" method="post">
				<h2>User: <?= $_SESSION['username'] ?></h2>
				<h2><input type="submit" name="act" value="logout"></h2>
			</form>
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

<form action="createServices.php" method="post">
      <div id="content">

        <div>
          <label for="inputServiceName">Service Name</label>
          <input type="text" class="form-control" name="name" id="inputServiceName" placeholder="ServiceName">
        </div>

        <div>
          <label for="inputDescription">Description</label>
          <input type="text" class="form-control" name="description" id="inputDescription" placeholder="Description">
        </div>

        <div>
          <label for="inputPrice">Price</label>
          <input type="text" class="form-control" name="price" id="inputPrice">
        </div>
	
    
      <input type="submit" name="command" value="Add Service" />
    </form> 

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