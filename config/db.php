<?php 
    // connect to database
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // check connection
    if(!$conn) {
        die('Connection failed: ' .mysqli_connect_error());
    }
?>