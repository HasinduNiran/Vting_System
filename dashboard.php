<?php
session_start(); // Make sure to start the session
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Shot Voting</title>
    <link rel="stylesheet" href="css/dash.css" />
</head>

<body>

    <div class="wrapper">

        <div class="sidebar">
            <div class="profile">
                <img style="width: 100px; " src="image/pngegg.png" alt="" />
                <h3>One Shot Voting</h3>
                
            </div>
            <ul>
                <li>
                    <a href="#" class="active">
                        <span class="icon"><i class="fas fa-home"></i></span>
                        <span class="item">Home</span>
                    </a>
                </li>

                <li>
                    <a href="add_vote/add_vote.php">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span class="item"> Add Vote</span>
                    </a>
                </li>

                <li>
                    <a href="Candidate/vote.php">
                        <span class="icon"><i class="fas fa-users"></i></span>
                        <span class="item">View Candidates</span>
                    </a>
                </li>

                <li>
                    <a href="Contact_us/contactUs.php">
                        <span class="icon"><i class="fas fa-trash"></i></span>
                        <span class="item">Add Feedback</span>
                    </a>
                </li>

                <li>
                    <a href="profile/view.php">
                        <span class="icon"><i class="fas fa-address-book"></i></span>
                        <span class="item">My Profile</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <span class="icon"><i class="fas fa-address-book"></i></span>
                        <span class="item">Log Out</span>
                    </a>
                </li>
                </ul>
        </div>
    </div>

    <div>
        <!-- <div style="margin-top: 100px; margin-left: 500px; position: absolute ">
            <img src="image/chch.png" alt="">
        </div> -->
      
        
    </div>

</body>

</html>