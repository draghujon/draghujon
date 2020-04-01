<?php
    session_start();
    require 'connect.php';

    // if($_GET['id'])
    // {
    //     $_SESSION['post_id'] = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    //     $query = "SELECT id, comments, created_At FROM comments WHERE id=:id";

    //     $statement = $db->prepare($query);
    //     $statement->bindValue(':id', $_SESSION['post_id']);
    //     $statement->execute();
    //     $post = $statement->fetch();

    //     $post_comments = $post['comments'];
    //     $post_createdAt = $post['created_At'];
    // }
    // else
    // {
    //     echo "OK";
    // }
    if(!isset($_SESSION['id']))
    {
        $_SESSION['id'] = 0;
    }
    if(isset($_POST['create']))
    {
    var_dump ( $_POST);
    //exit;
        if(
           $_POST['comments'] === '')
        {
            $isTrue = false;
        }
        else
        {
            $isTrue = true;
        }

        if($_POST['create'] === 'Create' && $isTrue)
        {
            print_r($_SESSION);
            //exit;
            //Do the insert query
            //$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $comments = filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
            $created_At = filter_input(INPUT_POST, 'created_At', FILTER_SANITIZE_STRING);

            //$query = "INSERT INTO comments (comments, created_At)
                      //VALUES (:comments, :created_At)";
                    $query = "INSERT INTO comments (UserIdFK, ServiceIdFK, comments) VALUES (:userIdFK, :serviceIdFK, :comments)";
            $statement = $db->prepare($query);
            $statement->bindValue(':userIdFK', $_SESSION['id']);
            $statement->bindValue(':serviceIdFK', 0);
            $statement->bindValue(':comments', $comments);
            
            $statement->execute();

            $insert_id = $db->lastInsertId();
            
            header("Location: index.php");
        }
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
            <h1>Welcome to CF Computing : Create Comment</h1>
        <?php else: ?>
            <h1>Welcome to CF Computing : Create Comment<br></h1>
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

    <form action="createComment.php" method="post">

<?php if(!isset($_SESSION['id'])): ?>
    <p>You are not logged in, what is your user name?</p>
        <div id="content">
            <div>
              <label for="inputUserName">User Name</label>
              <input type="text" class="form-control" name="username" id="inputUserName" placeholder="UserName">
            </div>
        </div>

<?php endif ?>
        <p></p>
<?php if(isset($_SESSION['id']) || !isset($_SESSION['id'])): ?>
    <div id="content">
        <div>
          <label for="inputComments">Comments</label>
        </div>
        <div>
          <p>
            <textarea name="comments" class="form-control" id="inputComments"></textarea>
          </p>
        </div>
    </div>

<?php endif ?>     
    <!-- <a href="updateDeleteServices.php?id=<?= $id ?>" type="update">Update</a> -->
    
      <input type="submit" name="create" value="Create" />

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

