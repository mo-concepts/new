<?php
    session_start();
    include_once 'includes/dbh.inc.php';
    $sessionid = $_SESSION['u_id'];

    $fileName = "uploads/profile".$sessionid."*";
    $fileInfo = glob($fileName);
    $fileExt = explode(".", $fileInfo[0]);
    $fileActExt = $fileExt[1];
    
    $file = "uploads/profile".$sessionid.".".$fileActExt;

    if (!unlink($file)) {
        echo "file was not deleted";
    } else {
        echo "file was deleted";
    }

    $sql = "UPDATE profileimg SET status=1 WHERE userid='$sessionid';";
    mysqli_query($conn, $sql);

    header("Location: home.php?imagedeleted");