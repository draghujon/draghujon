<?php
    session_start();
    require 'connect.php';
var_dump($_GET);
//exit;
if($_GET['id'])
{
    $_SESSION['id'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT comments FROM comments WHERE id=:id";
    var_dump($query);
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $_SESSION['id']);
    $statement->execute();
    $post = $statement->fetch();


    $post_comments = $post['comments'];
    //$post_createdAt = $post['created_At'];
}

if(isset($_POST['update']))
{
    //echo $_POST['id'];
    //$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    //$serviceId = filter_input(INPUT_POST, 'serviceIdFK', FILTER_VALIDATE_INT);
    $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
    //$created_At = filter_input(INPUT_POST, 'created_At', FILTER_SANITIZE_STRING);

    $query = "UPDATE comments SET comments = :comments WHERE id = :id";

    $statement = $db->prepare($query);
    $statement->bindValue(':id', $_SESSION['id']);
    //$statement->bindValue(':userId', $userId);
    //$statement->bindValue(':serviceId', $serviceId);
    $statement->bindValue(':comments', $comments);
    //$statement->bindValue(':created_At', $created_At);
    $statement->execute();

    header("Location: index.php?id={$_SESSION['id']}");
}

if(isset($_POST['delete']))
{
    $query = "DELETE FROM comments WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $_SESSION['id']);
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
            <h1>Welcome to CF Computing : Update Comments</h1>
        <?php else: ?>
            <h1>Welcome to CF Computing : Update Comments<br></h1>
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

    <form action="updateComments.php" method="post">
      <div id="content">

        <div>
          <label for="inputComments">Comments</label>
          <p>
            <textarea name="comments" class="form-control" id="inputComments"><?= $post_comments ?></textarea>
          </p>
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

