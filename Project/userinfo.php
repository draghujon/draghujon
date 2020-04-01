<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 13, 2020
    Description: Userinfo PHP

----------------->
<?php
session_start();
if(isset($_POST['command']))
{
	require 'connect.php';
	if($_POST['command'] === 'Select')
	{
		$query = "SELECT id, username FROM user";

		$statement = $db->prepare($query);
		$statement->execute();
	}

	if($_POST['command'] === 'Update')
	{
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
		$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
		$streetaddy = filter_input(INPUT_POST, 'streetaddy', FILTER_SANITIZE_STRING);
		$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
		$province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
		$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
		
		$hash = password_hash($password, PASSWORD_DEFAULT);

	    $query = "UPDATE user SET username = :username, password = :hash, firstname = :firstname, lastname = :lastname, streetaddy = :streetaddy, city = :city, province = :province, email = :email, phone = :phone WHERE id = :id";

		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->bindValue(':username', $username);
		$statement->bindValue(':hash', $hash);
		$statement->bindValue(':firstname', $firstname);
		$statement->bindValue(':lastname', $lastname);
		$statement->bindValue(':streetaddy', $streetaddy);
		$statement->bindValue(':city', $city);
		$statement->bindValue(':province', $province);
		$statement->bindValue(':email', $email);
		$statement->bindValue(':phone', $phone);
		$statement->execute();

		$insert_id = $db->lastInsertId();
	}

	if($_POST['command'] === 'Delete')
	{
		$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

		$query = "DELETE FROM user WHERE id = :id";

		$statement = $db->prepare($query);
		$statement->bindValue(':id', $id);
		$statement->execute();
	}	

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
	}
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
			<h1>Welcome to CF Computing : User Info</h1>
		<?php else: ?>
			<h1>Welcome to CF Computing : User Info<br></h1>
			<form action="userinfo.php" method="post">
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
		<?php if(isset($_SESSION['id'])): ?>
				<?= "ID: " . $_SESSION['id'] ?><br>
				<?= "Username: " . $_SESSION['username'] ?><br>
				<?= "First name: " . $_SESSION['firstname'] ?><br>
				<?= "Last name: " . $_SESSION['lastname'] ?><br>
				<?= "Street: " . $_SESSION['streetaddy'] ?><br>
				<?= "City: " . $_SESSION['city'] ?><br>
				<?= "Province: " . $_SESSION['province'] ?><br>
				<?= "Email: " . $_SESSION['email'] ?><br>
				<?= "Phone: " . $_SESSION['phone'] ?><br>
		<?php endif ?>
	</div>
	<?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
		<div> 
			<form action="userinfo.php" method="post">
				<div id="content">

				  <p>You are an admin so you have access to these CRUD functionalities</p>
			      <input type="submit" name="command" value="Select" />
			      <input type="submit" name="command" value="Update" />
			      <input type="submit" name="command" value="Delete" />
			</form>
		</div>
	<?php endif ?>

	<?php if(isset($_POST['command']) && $_POST['command'] === 'Delete'): ?>
		<form action="userinfo.php" method="post">
			<div id="content">
				<div>
				  <label for="inputUserId">Id to Delete</label>
				  <input type="text" class="form-control" name="id" id="inputId" placeholder="Id">
				</div>
			</div>
			<input type="submit" name="command" value="Delete" />
		</form>
	<?php endif ?>

	<?php if(isset($_POST['command']) && $_POST['command'] === 'Update'): ?>
		<form action="userinfo.php" method="post">
			<div id="content">
				<div>
				  <label for="inputUserId">Id to modify</label>
				  <input type="text" class="form-control" name="id" id="inputId" placeholder="Id">
				</div>
		        <div>
		          <label for="inputUsername">Username</label>
		          <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Username">
		        </div>
		        <div>
		          <label for="inputPassword">Password</label>
		          <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
		        </div>
		        <div>
		          <label for="firstName">First Name</label>
		          <input type="text" class="form-control" name="firstname" id="firstName">
		        </div>
				<div>
		          <label for="lastName">Last Name</label>
		          <input type="text" class="form-control" name="lastname" id="lastName">
		        </div>
		      </div>

		      <div id="content">
			      <div>
			        <label for="inputAddress">Street and #</label>
			        <input type="text" class="form-control" name="streetaddy" id="inputAddress" placeholder="1234 Main St">
			      </div>

		          <div>
		            <label for="inputCity">City</label>
		            <input type="text" name="city" class="form-control" id="inputCity">
		          </div>

		        <div>
		          <label for="inputProv">Province</label>
		          <select name="province" id="inputProv" class="form-control">
		            <option selected>Choose...</option>
		            <option value="Alberta">Alberta</option>
		            <option value="British Columbia">British Columbia</option>
		            <option value="Manitoba">Manitoba</option>
		            <option value="New Brunswick">New Brunswick</option>
		            <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
		            <option value="Nova Scotia">Nova Scotia</option>
		            <option value="Ontario">Ontario</option>
		            <option value="Prince Edward Island">Prince Edward Island</option>
		            <option value="Quebec">Quebec</option>
		            <option value="Saskatchewan">Saskatchewan</option>
		          </select>
		        </div>

		          <div>
		            <label for="inputPostal">Postal Code</label>
		            <input type="text" class="form-control" id="inputPostal">
		          </div>
		          <div>
		            <label for="email">Email</label>
		            <input type="email" name="email" class="form-control" id="email">
		          </div>
		          <div>
		            <label for="phone">Phone</label>
		            <input type="phone" name="phone" class="form-control" id="phone">
		          </div>
      		</div>
      		<input type="submit" name="command" value="Update" />
      	</form>

	<?php endif ?>
		<div>
			<?php if(isset($statement)): ?>
				<?php if ($statement->rowCount() > 0): ?> 
				    <?php while($row = $statement->fetch()): ?>
				        <?= "id: " . $row["id"] . " - UserName: " . $row["username"] . "<br>"; ?>
				    <?php endwhile ?>
				<?php endif ?>
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
	</body>
</html>