<?php
    include("connect.php");

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $role = $_POST['role'];

    if($password==$cpassword){
        
        $insert = mysqli_query($connect, "INSERT INTO users (name, mobile, address, password, role, status, votes) VALUES ('$name', '$mobile', '$address', '$password', '$role', 0, 0)");
        if($insert){
            echo '<script>
                    alert("Registration successfull!");
                    window.location = "../index.html";
                </script>';
        }
        else{
            echo '<script>
            alert("some error occured!");
            
        </script>';
        }
    }
    else{
        echo '<script>
        alert("Password and confirm password do not match!");
        window.location = "../routes/register.html";
    </script>';
    }
    
?>