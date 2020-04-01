<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 12, 2020
    Description: Index PHP

----------------->
<?php
	session_start();
	require 'connect.php';
	//re	require 'connect.php';quire 'authenticate.php';
	
	if(!isset($_SESSION['username']))
	{
		$_SESSION['username'] = 'Guest';

	}

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
	else
	{

	}
	
		$query = "SELECT c.id, c.userIdFK, c.comments, c.created_At, u.username FROM comments c LEFT JOIN user u ON u.id = c.userIdFK ORDER BY c.created_At DESC";

        $statement = $db->prepare($query); 

        $statement->execute(); 

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="cfstyles.css" />
	<script></script>
	<title>CF Computing</title>
</head>
<body>
	<header>
		<?php if(!isset($_SESSION['id'])): ?>
			<h1>Welcome to CF Computing : Home</h1>
		<?php else: ?>
			<h1>Welcome to CF Computing : Home</h1>
			<form action="index.php" method="post">
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
	<div id= "content">
		<p align="center">Welcome to my page, check out my various pages to see what we offer.</p> 
	</div>
	<div class="mylogo">
		<!-- This is MY personal LOGO from my real business I ran so there is no credit for the image except to myself :) -->
	</div>
	

		
			<h4><a href="createComment.php">Create a comment</a></h4>
	
        <?php while ($row = $statement->fetch()): ?>
		

        <div class="comments">
          <h4><?= "Created at: " . $row['created_At'] ?></h4>
          <p>
          	<?= "Username: " . $row['username'] ?>
          	<br />
          	<br />
            <?= $row['comments'] ?>
            <?= $row['id'] ?>
          </p>
          <p>
            <small>
            	<?php var_dump($row); ?>
              <?php if(isset($_SESSION['admin'])): ?>
              	<a href="updateComments.php?id=<?= $row['id'] ?>">edit</a>
<!--               <form action="updateDeleteServices.php?id={$row['id']}" method="GET">

                <input type="submit" name="command" value="edit">
              </form> -->
              <?php endif ?>
            </small>
          </p>

        </div>


    <?php endwhile ?>
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
	</body>
</html>