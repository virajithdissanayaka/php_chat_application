<?php
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($email) && !empty($password)){
        // Let's check users entered email & password match to database any table row email and password
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if(mysqli_num_rows($sql) > 0){ // If user record is available in the database
            $row = mysqli_fetch_assoc($sql);
            $status = "Active now";
            //updating the status to active now once user logged in successfully
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if($sql2){
                $_SESSION['unique_id'] = $row['unique_id']; // Using this session we used user unique_id in other php file
                echo "success";
            }   
        }else{
            echo "Email or Password is Incorrect!";
        }
    }else{
        echo "All input fields are required!";
    }
?>    