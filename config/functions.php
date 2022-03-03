<?php 
    require('config/db.php');

    // register/login variables
    $name = $username = $password = $conf_password = '';
    $nameErr = $usernameErr = $passwordErr = $status = '';
    $submitErr = 0;

    // function to login the user
    function login() {
        global $name, $username, $password, $conf_password, $nameErr, $usernameErr, $passwordErr, $submitErr, $error, $conn;

        if (empty($_POST['username'])) {
            // error, username is not provided
            $usernameErr = 'Please enter your username';
            $submitErr++;
        } else {
            $username = htmlspecialchars($_POST['username']);
        }

        if (empty($_POST['password'])) {
            // error, username is not provided
            $passwordErr = 'Please enter your password';
            $submitErr++;
        } else {
            $password = $_POST['password'];
        }

        if ($submitErr == 0) { // submit successfull 
            $query = "SELECT * FROM users WHERE username='".$username."'";
            // get result
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) { // username exists in db
                $user = mysqli_fetch_assoc($result);

                if (password_verify($password, $user['password'])) { // inputted pwd matches db pwd
                    $_SESSION['isLoggedIn'] = 'successful';
                    $_SESSION['name'] = $user['name'];
                    // send logged in user to home page
                    header('Location: ' .ROOT_URL);
                } else {
                    $passwordErr = "The password was incorrect.";
                }
            } else {
                $usernameErr = "This username is incorrect.";
            }
        }
    }

    // function to register a new user
    function register() {
        global $name, $username, $password, $conf_password, $nameErr, $usernameErr, $passwordErr, $submitErr, $error, $conn, $status;

        // validate name input
        if (empty($_POST['name'])) {
            $status= 'Submitting...';
            // error, name is not provided
            $nameErr = 'Please enter your name';
            $submitErr++;
        } else {
            $name = htmlspecialchars($_POST['name']);
            if (preg_match('/[^A-Za-z0-9]/', $name)) {
                // error, input contains invalid chars
                $nameErr = 'Name can only contain letters and numbers.';
                $submitErr++;
            }
        }

        // validate username input
        if (empty($_POST['username'])) {
            // error, username is not provided
            $usernameErr = 'Please enter a username';
            $submitErr++;
        } else {
            $username = htmlspecialchars($_POST['username']);
            if (preg_match('/[^A-Za-z0-9]/', $username)) {
                // error, input contains invalid chars
                $usernameErr = 'Username can only contain letters and numbers.';
                $submitErr++;
            }
            // check if username has already been taken
            // $query = "SELECT * FROM users WHERE username = {$username}";
            $query = "SELECT * FROM users WHERE username='".$username."'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0) {
                $usernameErr = 'Sorry, this username already exists.';
                $submitErr++;
            }
        }

        // validate password input
        if (empty($_POST['password'])) {
            $passwordErr = 'Please enter a password.';
            $submitErr++;
        } elseif (empty($_POST['conf_password'])) {
            $passwordErr = 'Please confirm your password.';
            $submitErr++;
        } else {
            $password = $_POST['password'];
            $conf_password = $_POST['conf_password'];
            if($password != $conf_password) {
                $passwordErr = 'Passwords do not match.';
                $submitErr++;
            }
        }

        // if all inputs are valid, send to database
        if ($submitErr === 0) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // insert user credentials into database
            $query = "INSERT INTO users(name, username, password) VALUES('$name', '$username', '$hashedPassword')";
            if(mysqli_query($conn, $query)) {
                $_SESSION['isLoggedIn'] = 'successful';
                $_SESSION['name'] = $name;
                header('Location: ' .ROOT_URL);
            } else {
                $error = 'ERROR: ' .mysqli_error($conn);
            }
        }
    }

    // function to check if the user is logged in
    // if not logged in, go to login page
    function checkLogStatus() {
        if(empty($_SESSION['isLoggedIn'])) {
            header('Location: ' .ROOT_URL. 'login.php');
        }
    }

    // function to logout the user
    function logout() {
        $_SESSION['isLoggedIn'] = '';
        $_SESSION['name'] = '';
    }

    // check for form submissions

    if(isset($_POST['logout'])) {
        logout();
    }

    if(isset($_POST['register'])) {
        register();
    }

    if(isset($_POST['login'])) {
        login();
    }
?>