</head>
<body>
    <header>
        <nav>
            <h2>Timekeeper</h2>
            <?php if(!empty($_SESSION['isLoggedIn'])): ?>
            <ul>
                <li><a class="nav-link" href="index.php">Home</a></li>
                <li><a class="nav-link" href="#">New Session</a></li>
            </ul>
            <div class="nav_right">
                <p>Welcome, <?php echo $_SESSION['name']; ?></p>
                <form class="nav_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="submit" value="Logout" name='logout'>
                </form>
            </div>
            <?php endif; ?>
        </nav>
    </header>