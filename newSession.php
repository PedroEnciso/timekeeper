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
        <h2>New Session</h2>
            <form action="">
                <h3>Choose your Project</p>
                <?php if(false): ?>
                    <p>Please add a project.</p>
                <?php endif;?>
                <select name="session-name">
                    <option value="">Select</option>
                    <option value="php">php</option>
                </select>
                <div class="timer">
                    <input type="num" disabled >
                    <div class="time">
                        <span id="hr">00</span>
                        <span id="min">00</span>
                        <span id="sec">00</span>
                    </div>
                </div>
                <button id="start" type="button">Start</button>
                <button id="pause" type="button" disabled >Pause</button>
                <button id="reset" type="button">Reset</button>
                <button id="submit" type="submit" name="session-submit" disabled >Submit Session</button>
            </form>
            <form action="">
                <p>Starting a new project? Add it here.</p>
                <div>
                    <label for="session-name">Name your project:</label>
                    <input type="text" name="new-session-name">
                    <input type="submit" name="new-project-name" value="Add">
                </div>
            </form>
        </section>
    </main>


    <script src="js/main.js"></script>

</body>
</html>