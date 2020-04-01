<!-- Chris Feasby
   CRUD Project
   Section 2
   March 12, 2020
-->

<?php
    define('DB_DSN','mysql:host=localhost;dbname=crudproject');
    define('DB_USER','root');
    define('DB_PASS','');  
    //define('USER', '$username');   
    //define('PASSWORD', '$password');

    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }
    echo 'connected!';
?>
