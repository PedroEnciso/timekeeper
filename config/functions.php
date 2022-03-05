<?php 
    require('config/db.php');

    // register/login variables
    $name = $username = $password = $conf_password = '';
    $nameErr = $usernameErr = $passwordErr = $status = '';
    $submitErr = 0;

    // function to login the user
    function login() {
        global $name, $username, $password, $conf_password, $nameErr, $usernameErr, $passwordErr, $submitErr, $status, $conn;

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
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) { // username exists in db
                $user = $result->fetch_assoc();

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
            // prepared statement to see if username is in db
            $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) { // username is already in the db
                $usernameErr = 'Sorry, this username already exists.';
                $submitErr++;
            }
            // close the prepared statement
            $stmt->close();
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

        if ($submitErr === 0) { // all inputs are valid, send to db
            // hash and salt the user's pssword
            $pwdHash = password_hash($password, PASSWORD_DEFAULT);
            // prepare statement to input user credentials
            $stmt = $conn->prepare("INSERT INTO users (name, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $name, $username, $pwdHash);
            $stmt->execute();
            if($stmt->error) { // submission to db failed
                $status = 'Sorry, something went wrong. Please try again.';
            } else { //successful
                $_SESSION['isLoggedIn'] = 'successful';
                 $_SESSION['name'] = $name;
                header('Location: ' .ROOT_URL);
            }
            $stmt->close();
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