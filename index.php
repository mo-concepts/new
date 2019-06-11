<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<?php
    include_once 'login.php';
?>
<section id="main-container">
    <div id="main-wrapper">
        <h2>SIGN-UP</h2>
    </div>
</section>
<div id="formdiv">
<h2>Create your Profile</h2>
<form id="form" action="includes/signup.inc.php" method="POST">
<?php
    if (isset($_GET['first'])) {
        $first = $_GET['first'];
        echo '<input type="text" name="first" placeholder="Firstname" value="'.$first.'">';
        echo'<br>';
    } else {
        echo '<input type="text" name="first" placeholder="Firstname">';
        echo'<br>';
    }
    if (isset($_GET['last'])) {
        $last = $_GET['last'];
        echo '<input type="text" name="last" placeholder="Lastname" value="'.$last.'">';
        echo'<br>';
    } else {
        echo '<input type="text" name="last" placeholder="Lastname">';
        echo'<br>';
    }
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        echo '<input type="text" name="email" placeholder="E-mail" value="'.$email.'">';
        echo'<br>';
    } else {
        echo '<input type="text" name="email" placeholder="E-mail">';
        echo'<br>';
    }
    if (isset($_GET['username'])) {
        $username = $_GET['username'];
        echo '<input type="text" name="username" placeholder="Username" value="'.$username.'">';
        echo'<br>';
    } else {
        echo '<input type="text" name="username" placeholder="Username">';
        echo'<br>';
    }
?>
    <input type="password" name="password" placeholder="Password">
    <br>
    <button type="submit" name="submit">Submit</button>
<?php
    /*$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($fullUrl, "signup=empty") == true) {
        echo '<p id="error">You did not fill in all fields!</p>';
        exit();
    }
    elseif (strpos($fullUrl, "signup=char") == true) {
        echo '<p id="error">Invalid characters!</p>';
        exit();
    }
    elseif (strpos($fullUrl, "signup=invalidemail") == true) {
        echo '<p id="error">Invalid E-mail!</p>';
        exit();
    }
    elseif (strpos($fullUrl, "signup=success") == true) {
        echo '<p id="success">Sign up successful!</p>';
        exit();
    }*/

    if (!isset($_GET['signup'])) {
        exit();
    } else {
        $signupCheck = $_GET['signup'];
        if ($signupCheck == "empty") {
            echo '<p id="error">You did not fill in all fields!</p>';
            exit();
        }
        elseif ($signupCheck == "char") {
            echo '<p id="error">Invalid characters!</p>';
            exit();
        }
        elseif ($signupCheck == "invalidemail") {
            echo '<p id="error">Invalid e-mail!</p>';
            exit();
        }
        elseif ($signupCheck == "usertaken") {
            echo '<p id="error">Username already taken!</p>';
            exit();
        }
        elseif ($signupCheck == "success") {
            echo '<p id="success">Sign up successful!</p>';
            exit();
        }
    }
?>
</form>
</div>

</body>
</html>