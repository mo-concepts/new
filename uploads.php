<?php
include_once 'includes/dbh.inc.php';
session_start();
$id = $_SESSION['u_id'];
if (isset($_POST['submit'])) {
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileError = $file['error'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];

    $fileExt = explode('.', $fileName);
    $fileActExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');
    
    if (in_array($fileActExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = "profile".$id.".".$fileActExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $sql = "UPDATE profileimg SET status=0 WHERE userid='$id';";
                mysqli_query($conn, $sql);

                header("Location: home.php?uploadsuccess");
            } else {
                echo 'Your file should be less than 1mb!';
            }
        } else {
            echo 'There was an error uploading your file!';
        }
    } else {
        echo 'You cannot upload files of this type!';
    }
} else {
    header("Location: index1.php?error");
}