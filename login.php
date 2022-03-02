<?php
    require('config/config.php');
    require('config/db.php');
    require('config/functions.php');
?>

<?php include('inc/header.php'); ?>
    <title>Login</title>
    <?php include('inc/nav.php'); ?>

    <main>
        <h1>Login</h1>

        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
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
            <input type="submit" value="submit" name="login">
        </form>
        <p>Not signed up? Create an account <a href="<?php echo ROOT_URL; ?>register.php">here</a>.</p>
    </main>
    
</body>
</html>