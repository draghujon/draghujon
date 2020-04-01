<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 12, 2020
    Description: Services PHP

----------------->
<?php
	session_start();
    require 'connect.php';
	if(isset($_POST['act']))
	{
		if($_POST['act'] === 'logout')
		{
			unset($_SESSION['id']);
			unset($_SESSION['admin']);
			unset($_SESSION['username']);
			unset($_SESSION['firstname']);
			unset($_SESSION['lastname']);
			unset($_SESSION['streetaddy']);
			unset($_SESSION['city']);
			unset($_SESSION['province']);
			unset($_SESSION['email']);
			unset($_SESSION['phone']);
			session_unset();
		}
		else
		{
			
		}
	}
	
	
	if(isset($_SESSION['admin']))
	{
		if($_SESSION['admin'] === '1')
		{
			echo "You are the admin!";

		}
	}
	else
	{
		echo "You are not an admin!";
	}

        $query = "SELECT id, name, description, price FROM services";

        $statement = $db->prepare($query); // Returns a PDOStatement object.
        //$statement->bindValue(':id', $id); 
        $statement->execute(); // The query is now executed.
        
        //$row = $statement->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="cfstyles.css" />
	<script></script>
	<title>Services</title>
</head>
<body>
	<header>
		<?php if(!isset($_SESSION['id'])): ?>
			<h1>Welcome to CF Computing : Services</h1>
		<?php else: ?>
			<h1>Welcome to CF Computing : Services<br></h1>
			<form action="services.php" method="post">
				<h2>User: <?= $_SESSION['username'] ?></h2>
				<h2><input type="submit" name="act" value="logout"></h2>
			</form>
		<?php endif ?>
	</header>
	<nav id = "banner">
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
	<?php if(isset($_SESSION['admin'])): ?>
		<h2><a href="createServices.php">Create Services</a></h2>
	<?php endif ?>
	<h2>Welcome to my services page, please check below for more information!</h2>
	
	<?php while ($row = $statement->fetch()): ?>
        <div class="services">
          <h4><?= $row['name'] ?></h4>
          <p>
            <?= $row['description'] ?>
            <?= $row['id'] ?>
          </p>
          <p>
            <small>
              <?= $row['price'] ?>
              <?php if(isset($_SESSION['admin'])): ?>
              	<a href="updateDeleteServices.php?id=<?= $row['id'] ?>">edit</a>
<!--               <form action="updateDeleteServices.php?id={$row['id']}" method="GET">

                <input type="submit" name="command" value="edit">
              </form> -->
              <?php endif ?>
            </small>
          </p>

        </div>
    <?php endwhile ?>

	<footer id = "footer">
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
	</body>
</html>