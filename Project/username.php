<!-------f--------

    CRUD project
    Name: Chris Feasby
    Date: March 12, 2020
    Description: Username PHP

----------------->

<?php
  
    require_once 'connect.php';
    require 'authenticate.php';
    $db = DB();


    // $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    // $admin = filter_input(INPUT_POST, 'admin', FILTER_VALIDATE_INT);
    // $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    // $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    // $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    // $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    // $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
  //if(admin != 0) // true
    // $_POST['id'] = $id;
    // $_POST['admin'] = $admin;
  $id = $_GET['id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
    // $_POST['firstname'] = $firstname;
    // $_POST['lastname'] = $lastname;
    // $_POST['address'] = $address;
    // $_POST['phone'] = $phone;

    // check Login request


      //$username = trim($_POST['username']);
      //$password = trim($_POST['password']);

      if ($username == "") 
      {
          $login_error_message = 'Username field is required!';
      } 
      else if ($password == "") 
      {
          $login_error_message = 'Password field is required!';
      } 
      else 
      {
          $id = Login($username, $password); // check user login
          if($id > 0)
          {
              $_SESSION['id'] = $id; // Set Session
              echo "IN if($id > 0)";
              //header("Location: signup.php"); // Redirect user to the profile.php
          }
          else
          {
              $login_error_message = 'Invalid login details!';
              //header("Location: signup.php"); 
          }
      }

    /*
     * Login
     *
     * @param $username, $password
     * @return $mixed
     * */
    function Login($username, $password)
    {
        try 
        {
            
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $query = "SELECT * FROM 'User'";
            // $query = "SELECT 'id' FROM 'user' WHERE ('username'=':username') AND ('password'=':password')";
            $statement = $db->prepare($query);
            $statement->bindParam("username", $username, PDO::PARAM_STR);
            $statement->bindParam("password", $password, PDO::PARAM_STR);
            //$enc_password = hash('sha256', $password);
            //$query->bindParam("password", $enc_password, PDO::PARAM_STR);
            $statement->execute();

            if ($statement->rowCount() > 0) 
            {
                $result = $statement->fetch(PDO::FETCH_OBJ);
                return $db->lastInsertId();
            }
            echo $statement->rowCount();
            //isUsername($username);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

        /*
     * Check Username
     *
     * @param $username
     * @return boolean
     * */
    function isUsername($username)
    {
        try {
            require 'connect.php';
            $query = $db->prepare("SELECT id FROM user WHERE username=:username");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
    $row = $statement->fetch();
?>
<!-- // global $response;
// $username = $_POST['username'];
// if($_POST['command'] === 'Sign Up')
// {
// 	echo 'You are here ' . $username;
// }
// else if($_POST['command'] === 'Sign In')
// {
//   $registered_usernames = ['wallyg', 'dglutton', 'stungeye', 'mirage', 'chin', 'alan'];

//   $response = [
//     'success' => false,
//     'usernameAvailable' => false
//   ];

//   if (isset($_POST['username']) && (strlen($_POST['username']) !== 0)) {
//     $response['usernameAvailable'] = ! in_array($_POST['username'], $registered_usernames);
//     $response['success'] = true;
//   } 
// }
//   // Set the JSON MIME content type so that it isn't sent as text/html
//   header('Content-Type: text/html');

//   // Encode the $response into JSON and echo.
//   echo json_encode($response);
 -->

<!DOCTYPE html>
<html>
<head>
	<title>Username</title>
	<link rel="stylesheet" type="text/css" href="cfstyles.css" />
</head>
<body>
<!-- <p><?= "The signed in user id: " . $id ?></p>  
	<p><?= "Is the user an admin(1-0): " . $admin ?></p> -->

    <p><?= "The signed in user's id: " . isUsername($username) ?></p>
      <p><?= "The signed in user's password: " . $password ?></p>
        <!-- <p><?= "The signed in user's firstname: " . $firstname ?></p>
          <p><?= "The signed in user's lastname: " . $lastname ?></p>
            <p><?= "The signed in user's address: " . $address ?></p>
              <p><?= "The signed in user's phone: " . $phone ?></p> -->
</body>
</html>