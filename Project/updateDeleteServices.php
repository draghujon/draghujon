<?php
    session_start();
    require 'connect.php';

if($_GET['id'])
{
    $_SESSION['post_id'] = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $query = "SELECT id, name, description, price FROM services WHERE id=:id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $_SESSION['post_id']);
    $statement->execute();
    $post = $statement->fetch();

    $post_name = $post['name'];
    $post_desc = $post['description'];
    $post_price = $post['price'];
}

if(isset($_POST['update']))
{
    $serviceName = filter_input(INPUT_POST, 'servicename', FILTER_SANITIZE_STRING);
    $serviceDescription = filter_input(INPUT_POST, 'servicedesc', FILTER_SANITIZE_STRING);
    $servicePrice = filter_input(INPUT_POST, 'serviceprice', FILTER_VALIDATE_FLOAT);

    $query = "UPDATE services SET name = :name, description = :description, price = :price WHERE id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $_SESSION['post_id']);
    $statement->bindValue(':name', $serviceName);
    $statement->bindValue(':description', $serviceDescription);
    $statement->bindValue(':price', $servicePrice);
    $statement->execute();

    header("Location: updateDeleteServices.php?id={$_SESSION['post_id']}");
}

if(isset($_POST['delete']))
{
    $query = "DELETE FROM services WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $_SESSION['post_id']);
    $statement->execute();

    header("Location: index.php");
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

    <form action="updateDeleteServices.php" method="post">
      <div id="content">

        <div>
          <label for="inputServiceName">Service Name</label>
          <input type="text" class="form-control" name="servicename" id="inputServiceName" value="<?= $post_name ?>">
        </div>

        <div>
          <label for="inputDescription">Description</label>
          <p>
            <textarea name="servicedesc" class="form-control" id="inputDescription"><?= $post_desc ?></textarea>
          </p>
        </div>

        <div>
          <label for="inputPrice">Price</label>
          <input type="text" class="form-control" name="serviceprice" id="inputPrice" value="<?= $post_price ?>">
        </div>
        
    <!-- <a href="updateDeleteServices.php?id=<?= $id ?>" type="update">Update</a> -->
    
      <input type="submit" name="update" value="Update" />
       <input type="submit" name="delete" value="Delete" />
    </form> 

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

