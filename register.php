<?php
    require('config/config.php');
    require('config/functions.php');
?>

<?php include('inc/header.php'); ?>
    <title>Register</title>
    <?php include('inc/nav.php'); ?>

    <main>
        <h1>Create an account</h1>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
            <div>
                <label for="name">Name/nickname:</label>
                <input type="text" name="name" value="<?php echo $name ?>">
                <span><?php echo $nameErr ?></span>
            </div>
            <div>
                <label for="username">User Name:</label>
                <input type="text" name="username" value="<?php echo $username ?>">
                <span><?php echo $usernameErr ?></span>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password">
                <span><?php echo $passwordErr ?></span>
            </div>
            <div>
                <label for="conf_password">Confirm Password:</label>
                <input type="password" name="conf_password">
            </div>
            <input type="submit" value="submit" name="register">
            <p><?php echo $status ?></p>
        </form>
        <p>Already signed up? Log in <a href="login.php">here</a>.</p>
    </main>
    
</body>
</html>