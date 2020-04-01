<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 12, 2020
    Description: Signup PHP

----------------->

<?php
	// require_once 'authenticate.php';
	// require_once 'connect.php';
	// //$login = false;
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    //$admin = filter_input(INPUT_POST, 'admin', FILTER_VALIDATE_INT);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $_POST['admin'] = 0;
    require_once 'connect.php';
    $query = "INSERT INTO `user` (`admin`, `username`, `password`, `firstname`, `lastname`, `address`, `phone`) VALUES ('0', '$username', '$password', '$firstname', '$lastname', '$address', '$phone')";
    $statement = $db->prepare($query);
    $statement->bindParam('username', $username, PDO::PARAM_STR);
    $statement->bindParam('password', $password, PDO::PARAM_STR);

    return false;
            
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
		<h1>Welcome to CF Computing : Sign Up</h1>
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

		<!-- <?php if($login = true): ?>
			<h1>User Logged in</h1>
		<?php else: ?>
    		<h1>User Sign up</h1>
    	<?php endif ?> -->

    <form action="signup.php" method="post">
      <div id="content">
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
	        <label for="inputAddress">Address</label>
	        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
	      </div>

          <div>
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity">
          </div>

        <div>
          <label for="inputProv">Province</label>
          <select name="address" id="inputProv" class="form-control">
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
            <input type="email" class="form-control" id="email">
          </div>
          <div>
            <label for="phone">Phone</label>
            <input type="phone" name="phone" class="form-control" id="phone">
          </div>

      </div>
      
      <input type="submit" name="command" value="Sign Up" />
    </form> 
  </div>

<!-- 	</div> -->

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