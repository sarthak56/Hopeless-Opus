<?php

if(isset($_POST['submit'])){ 
    include_once 'dbh.inc.php';
    
    $name=mysqli_real_escape_string($conn, $_POST['name']);
    $regno=mysqli_real_escape_string($conn, $_POST['regno']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $phone=mysqli_real_escape_string($conn, $_POST['phone']);
    $pwd=mysqli_real_escape_string($conn, $_POST['pwd']);
    
    if(empty($name) || empty($regno) || empty($email) || empty($phone) || empty($pwd)){
        header("Location: ../signup.php?signup=empty");
        exit();
    }
    else{
        if(!preg_match("/^[a-zA-Z]*$/", $name)){
            header("Location: ../signup.php?signup=invalid");
            exit();
        }
        else{
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("Location: ../signup.php?signup=email");
                exit();
            } else{
                $sql = "SELECT * FROM user WHERE regno='$regno' ";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                
                if($resultCheck > 0){
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                } else{
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO user (name,regno,email,phone,pwd,score,status) VALUES ('$name', '$regno', '$email', '$phone', '$hashedPwd', '$score','$status');";
                    mysqli_query($conn,$sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }
            }
        }
    }
} 
else{
        header("Location: ../signup.php");
        exit();
}