<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 23, 2020
    Description: UpdateServices PHP

----------------->

<?php
	require 'connect.php';
	session_start();
	if(isset($_POST['command']))
    {
        if($_POST['command'] === 'edit')
        {
            echo "HERE";
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $serviceName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $serviceDescription = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $servicePrice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            // Build the parameterized SQL query and bind sanitized values to the parameters

            $query = "UPDATE services SET name = :name, description = :description, price = :price WHERE id = :id";

            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);    
            $statement->bindValue(':name', $serviceName);    
            $statement->bindValue(':description', $serviceDescription); 
            $statement->bindValue(':price', $servicePrice);

            // Execute the INSERT prepared statement.
            $statement->execute();
        }
        else if($_POST['command'] === 'Delete')
        {
            require 'authenticate.php';
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            $query = "DELETE FROM services WHERE id = :id";

            $statement = $db->prepare($query);  
            $statement->bindValue(':id', $id); 
            $statement->execute();
            header("Location: index.php");
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
			<h1>Welcome to CF Computing : Update Services</h1>
		<?php else: ?>
			<h1>Welcome to CF Computing : Update Services<br></h1>
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

<form action="updateServices.php" method="post">
      <div id="content">

        <div>
          <label for="inputServiceID">ID(1-12):</label>
          <?= $_SESSION['service_id'] ?>
        </div>

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
	
    
      <input type="submit" name="command" value="Update" />
       <input type="submit" name="command" value="Delete" />
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
