<?php
    
    
    if(!isset($_POST['submit'])) {
        header("Location: ../index.php?signup=error");
        exit();
    } else {
        if(empty($_POST['first']) & empty($_POST['last']) & empty($_POST['email']) & empty($_POST['username']) & empty($_POST['password'])) {
            header("Location: ../index.php?signup=empty");
            exit();

            } else {
            include_once 'dbh.inc.php';
            
            $first = mysqli_real_escape_string($conn, $_POST['first']);
            $last = mysqli_real_escape_string($conn, $_POST['last']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            
            if(!preg_match("/^[a-zA-Z]*$/", $first) & !preg_match("/^[a-zA-Z]*$/", $last)) {
                header("Location: ../index.php?signup=char");
                exit();
            } else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header("Location: ../index.php?signup=invalidemail&first=$first&last=$last&username=$username");
                    exit();
                } else {
                    $sql = "SELECT * FROM users WHERE user_uid='$username';";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    if ($resultCheck > 0) {
                        header("Location: ../index.php?signup=usertaken&first=$first&last=$last&email=$email");
                        exit();
                    } else{
                        //Hashing the password
                        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
                        $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES (?, ?, ?, ?, ?);";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "SQL error";
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "sssss", $first, $last, $email, $username, $hashedpwd);
                            mysqli_stmt_execute($stmt);

                            $sql1 = "SELECT * FROM users WHERE user_uid='$username';";
                            $result1 = mysqli_query($conn, $sql1);
                            while ($row1 = mysqli_fetch_assoc($result1)) {
                                $id1 = $row1['user_id'];
                                $sqlimg = "INSERT INTO profileimg (userid, status) VALUES ('$id1', 1);";
                                $resultimg = mysqli_query($conn, $sqlimg);  
                            }
                            header("Location: ../index.php?signup=success");
                            exit();
                            
                        }
                    }
                }
            }
        }
    }