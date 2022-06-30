<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }
?>



<html>
    <head>
        <title>Online Voting System</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
        <link rel="icon" type="image/x-icon" href="../favicon.png">
    </head>
    <body>
        <style>
            body{
                background: #333C83;
            }
            #backbtn{
                padding: 5px;
                border-radius: 5px;
                background-color: #371B58;
                font-size: 15px;
                color: white;
                float: left;
                margin: 5px;
            }
            #logoutbtn{
                padding: 5px;
                border-radius: 5px;
                background-color: #371B58;
                font-size: 15px;
                color: white;
                float: right;
                margin: 5px;
            }
            #profile{
                border: 1px solid black;
                float:left;
                background-color: white;
                width= 40%;
                padding: 50px;
                margin-left: 60px;
                margin-top: 90px;
                
            }
            #group{
                border: 1px solid black;
                float: right;
                width: 60%;
                padding: 60px;
                height: auto;
                background: whitesmoke;
                margin-top: 30px;
                margin-right: 40px;
            }
            #votebtn{
                padding: 5px;
                margin-top: -55px;
                border-radius: 5px;
                background-color: #371B58;
                font-size: 15px;
                color: white;
            }
            #mainsection{
                padding: 10px;
                
            }
            #headersection{
                padding: 10px;
            }
            #voted{
                padding: 5px;
                border-radius: 5px;
                background-color: green;
                font-size: 15px;
                color: white;
            }
            h1{
                color: red;
            }
        </style>

        <div id="mainsection">
            <center>
            <div id="headersection">
            <a href="../"><button id="backbtn">Back</button> </a>
            <a href="logout.php"><button id="logoutbtn"> Logout</button></a>
                <h1>Online Voting System</h1>
             </div>
             </center>
            <hr>
            <div id="mainpannel">
                <div id="profile">
                    <b style="float: left">Name:</b> <?php echo $userdata['name']?> <br><br>
                    <b>Mobile:</b> <?php echo $userdata['mobile']?> <br><br>
                    <b>Address: </b> <?php echo $userdata['address']?> <br><br>
                    <b>Status:</b> <?php echo $status?> <br><br>
                </div>
                <div id="group">
                    <?php
                    include("../api/connect.php");
                    $groups = mysqli_query($connect, "SELECT * FROM users WHERE role=2");
                    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
                    $_SESSION['groupsdata'] = $groupsdata;
                    if($_SESSION['groupsdata']){
                        for($i=0; $i<count($groupsdata); $i++){
                            ?>
                            <div >
                                <b>Group Name: </b> <?php echo $groupsdata[$i]['name'] ?><br><br>
                                <b>Votes:  </b><?php echo $groupsdata[$i]['votes'] ?>
                                <form action="../api/vote.php" method="POST">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes'] ?>">
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
                                    <?php
                                        if($_SESSION['userdata']['status']==0){
                                            ?>
                                            <input type="submit" name="votebtn" value="Vote" id="votebtn">  
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <button disabled type="button" name="votebtn" value="Vote" id="voted">Voted</button>  
                                            <?php
                                        }
                                    ?>
                                </form>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                    else{

                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>