<?php
    include_once 'login.php';

    if (isset($_SESSION['u_id'])) {
        include_once 'index1.php';
        include_once 'includes/dbh.inc.php';
        echo '<section class="gallery-links">
        <div class="gallery">
        <h2>GALLERY</h2>
        <div class="gallery-container">
        ';

        $sql = "SELECT * FROM gallery ORDER BY imgOrderGallery DESC;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ..home.php?gallery=sqldisplay");
        } else {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="#">
                    <img src="img/gallery/'.$row["imgFullNameGallery"].'">
                    <h3>'.$row["titleGallery"].'</h3>
                    <p>'.$row["descGallery"].'</p>
                    </a>';
            }
        }
        echo '</div>
            </div>
            </section>';
        echo '<div class="galleryform">
            <h2>UPLOADS</h2>
            <form action="includes/gallery-upload.inc.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="filename" placeholder="File name...">
            <br>
            <input type="text" name="imgtitle" placeholder="Image Title...">
            <br>
            <input type="text" name="imgdesc" placeholder="Image Description...">
            <br>
            <input type="file" name="file">
            <br>
            <button type="submit" name="submit">SUBMIT</button>
            </form>
            </div>';
    } else {
    echo '<section id="main-container">
        <div id="main-wrapper">
        <h2>HOME</h2>
        </div>
        </section>';
            }
?>
        
</body>
</html> 