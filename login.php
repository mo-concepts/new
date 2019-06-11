<?php
    session_start();
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div>
            <ul>
                <li><a href="home.php">Home</a></li>
            </ul>
            <?php
                if (isset($_SESSION['u_id'])) {
                    echo '<form id="loginform" action="includes/logout.inc.php" method="POST">
                    <button type="submit" name="submit">Log out</button>
                    </form>';
                    
                } else {
                    echo '<form id="loginform" action="includes/login.inc.php" method="POST">
                    <input type="text" name="uid" placeholder="Username/e-mail">
                    <input type="password" name="pwd" placeholder="Password">
                    <button type="submit" name="loginsubmit">Log in</button>
                    <a href="index.php">Sign up</a>
                    </form>';  
                }
            ?>
            
        </div>
    </nav>
<?php
?>
</body>
</html> 