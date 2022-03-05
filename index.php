<?php
    require('config/config.php');
    require('config/functions.php');

    // check if user is logged in
    checkLogStatus();
?>

<?php include('inc/header.php'); ?>
    <title>Timekeeper</title>
    <?php include('inc/nav.php'); ?>

    <main>
        <section>
            <h2>Your sessions:</h2>
            <p><?php echo $_SESSION['isLoggedIn']; ?></p>
        </section>
    </main>
    
</body>
</html>