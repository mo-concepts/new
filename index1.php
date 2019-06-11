<?php
    include_once 'login.php';
?>
<!DOCTYPE html>
<head>
    <title></title>
</head>
<body>

<?php
    include_once 'includes/dbh.inc.php';
    

    $id = $_SESSION['u_id'];

    $sqlImg = "SELECT * FROM profileimg WHERE userid='$id';";
    $resultImg = mysqli_query($conn, $sqlImg);
    while ($rowImg = mysqli_fetch_assoc($resultImg)) {
        echo '<div id="profile">';
        

        if ($rowImg['status'] == 0) {
            $fileName = "uploads/profile".$id."*";
            $fileInfo = glob($fileName);
            $fileExt = explode(".", $fileInfo[0]);
            $fileActExt = $fileExt[1];
            echo "<img src='uploads/profile".$id.".".$fileActExt."?".mt_rand()."'>";
        } else {
        echo '<img src="uploads/profiledefault.png" id="profile-image">';
        }
        
        echo "<p>".$_SESSION['u_last']." ". $_SESSION['u_first']."</p>";
        echo '</div>';
    

        if ($rowImg['status'] == 0) {
            echo '<form action="uploads.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="file">
            <button type="submit" name="submit">UPLOAD</button>
            </form>';
            echo '<br>';
            echo '<br>';
            echo '<form action="deleteprofile.php" method="POST">
                <button type="submit" name="deletesubmit">Delete Profile Image</button>
                </form>';
        } else {
        echo '<form action="uploads.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">UPLOAD</button>
        </form>';
        }
    }
?>

</body>
</html>