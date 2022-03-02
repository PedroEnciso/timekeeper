</head>
<body>
    <header>
        <nav>
            <h2>Timekeeper</h2>
            <?php if(!empty($_SESSION['isLoggedIn'])): ?>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">New Session</a></li>
            </ul>
            <p>Welcome, <?php echo $_SESSION['name']; ?></p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="submit" value="Logout" name='logout'>
            </form>
            <?php endif; ?>
        </nav>
    </header>