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
        <section class="container">
            <h2>Your sessions:</h2>
            <div id="sessions"></div>
            <a href="newSession.php">+ New Session</a>
        </section>
    </main>
    
</body>
</html>