<?php
    include_once 'dbh.inc.php';

    if (isset($_POST['submit'])) {
        $newFileName = $_POST['filename'];
        if (empty($newFileName)) {
            $newFileName = "gallery";
        } else {
            $newFileName = strtolower(str_replace(" ", "-", $newFileName));
        }
        $imgTitle = $_POST['imgtitle'];
        $imgDesc = $_POST['imgdesc'];
        
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];

        $fileExt = strtolower(end(explode(".", $fileName)));

        $allowed = array("jpg", "jpeg", "png");

        
        if (in_array($fileExt, $allowed)) {
            if ($fileError == 0) {
                if ($fileSize < 5000000) {
                    $imageFullName = $newFileName.".".uniqid("", true).".".$fileExt;
                    $fileDestination = "../img/gallery/".$imageFullName;

                    if (empty($imgTitle) & empty($imgDesc)) {
                        header("Location: ../home.php?gallery=empty");
                    } else {
                        $sql = "SELECT * FROM gallery;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../home.php?gallery=sql");
                        } else {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            $rowCount = mysqli_num_rows($result);
                            $setImageOrder = $rowCount + 1;

                            $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, imgOrderGallery) VALUES (?, ?, ?, ?);";
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../home.php?gallery=sql");
                            } else {
                                mysqli_stmt_bind_param($stmt, "ssss", $imgTitle, $imgDesc, $imageFullName, $setImageOrder);
                                mysqli_stmt_execute($stmt);

                                move_uploaded_file($fileTmpName, $fileDestination);
                                header("Location: ../home.php?gallery=uploadsuccess");
                            }
                        }
                    }
                } else {
                    header("Location: ../home.php?gallery=largesize");
                    exit;
                }
            } else {
            header("Location: ../home.php?gallery=error");
            exit;
            }
        } else {
            header("Location: ../home.php?gallery=notallowed");
            exit;
        }
    } else {
        header("Location: ../home.php?error");
        exit;
    }