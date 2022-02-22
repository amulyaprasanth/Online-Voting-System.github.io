<?php
    session_start();
    include("connect.php");

    $votes = $_POST['gvotes'];
    $total_votes= $votes+1;
    $gid = $_POST['gid'];
    $uid = $_SESSION['id'];

    $update_votes = mysqli_query($connect, "UPDATE users SET votes='$total_votes' WHERE id='$gid'");
    $update_status = mysqli_query($connect, "UPDATE users SET status=1 WHERE id='$uid'");

    if($update_status and $update_votes){
        $groups = mysqli_query($connect, "SELECT * FROM users WHERE role=2");
        $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
        $_SESSION['userdata']['status'] = 1;
        $_SESSION['groupsdata'] = $groupsdata;
        echo '<script>
                    alert("Voting successfull!");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    else{
        echo '<script>
                    alert("Voting failed!.. Try again.");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    
?>