<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 23, 2020
    Description: ShowServices PHP

----------------->

<?php
    require 'connect.php';
    session_start();

   
    if(isset($_SESSION['id']))
    {
        $post_name = "";
        $post_desc = "";
        $post_price = "";
        $service_id = $_SESSION['id'];

        $query = "SELECT id, name, description, price FROM services";

        $statement = $db->prepare($query); // Returns a PDOStatement object.
        $statement->bindValue(':id', $service_id); 
        $statement->execute(); // The query is now executed.
        
        $row = $statement->fetch();
        

        $post_name = $row['name'];
        $post_desc = $row['description'];
        $post_price = $row['price'];

        echo $_SESSION['id'];
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CF Computing</title>
    <link rel="stylesheet" href="cfstyles.css" type="text/css">
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

    <?php while ($row = $statement->fetch()): ?>
        <div class="blog_post">
          <h4><?= $row['name'] ?></h4>
          <p>
            <?= $row['description'] ?>
          </p>
          <p>
            <small>
              <?= $row['price'] ?>
            <?php if($_SESSION['admin']): ?>
              <form action="updateDeleteServices.php" method="post">

                <h2><input type="submit" name="command" value="edit"></h2>
              </form>
            <?php endif ?>
            </small>
          </p>
          <p>
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
    <script src="main.js"></script>
    </body>
</html>

