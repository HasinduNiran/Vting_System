<?php
session_start(); // Ensure session is started

// Redirect if user is not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

include '../dbh.php'; // Include database connection script

// Retrieve user details from the database based on the user's ID
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM `user` WHERE id = ?";
    
    // Use prepared statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Now you can access user details like $user['firstname'], $user['lastname'], etc.
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Header/headcss.css">
    <link rel="stylesheet" href="../footer/footcss.css">
    <style>
        body {
            font-family: Arial, sans-serif; 
            background-image: url("../image/fullbg.jpg");
            background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 40px;
            font-weight: 600;
            text-align: left;
            color: #250993;
            border-bottom: 3px solid silver;
        }

        p {
            font-size: 25px;
            margin-bottom: 40px;
            color: #555;
        }

        .btn-container {
            margin-top: 20px;
        }

        .btn{
    margin: 10px;
    padding: 15px;
    width: 20vh;
    background-color: rgb(61, 150, 202);
    border-style: none;
    border-radius: 20px;
    font-size: 15px;
    color: aliceblue;
    font-family: Poppins , 'sans';
    transition: color 0.3s ease , background-color 0.3s ease;
}


        a:hover {
            background-color: #1156b3;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-delete {
            background-color: #ff3333;
        }

        .btn-delete:hover {
            background-color: #cc0000;
        }

        .detailscon {
            max-width: 650px;
            padding: 10px;
            margin: 20px 28px;
            box-shadow: 0 15px 20px #ABB2B9;
            width: 560px;
            position: relative;
            top: 50px;
            left: 10px;
        }

        /* Navbar Styles */
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #222;
            transition: top 0.3s;
            font-family: Arial, sans-serif;
            z-index: 1000; /* Ensure navbar is on top */
        }

        .containerr {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
        }

        .nav ul {
            display: flex;
            align-items: center;
            list-style: none;
            justify-content: center;
        }

        .nav a {
            text-decoration: none;
            color: #fff;
            padding: 7px 15px;
            transition: all 0.3s ease-in-out;
        }

        .nav a:hover,
        .nav a.current {
            color: #D80032;
            font-weight: bold;
        }
        /* Add this CSS to your existing styles */
#logout-link {
    margin: 10px;
    padding: 15px;
    width: 20vh;
    background-color: rgb(73, 202, 61);
    border-style: none;
    border-radius: 20px;
    font-size: 15px;
    color: aliceblue;
    font-family: Poppins , 'sans';
    transition: color 0.3s ease , background-color 0.3s ease;
}

#logout-link:hover {
    background-color: #0b7838;
}

    </style>
</head>
<body>
    <nav class="nav">
        <script src="../Header/headjs.js"></script>
        <div class="containerr">
            <h1 class="logo"><a href="index.php">One Shot Voting</a></h1>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="sign_up.php">Signup</a></li>
        
            </ul>
          </div>
    </nav>
   
<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
    <div class="detailscon">
        <?php if (isset($user)) : ?>
            <h2>Welcome<br> </h2>
            <p>Name: <?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></p>
            <p>Email: <?php echo $user['email']; ?></p>
            <p>Birthday: <?php echo $user['dob']; ?></p>
            <p>Phone: <?php echo $user['phone']; ?></p>
            <p>Password: <?php echo $user['password']; ?></p>
            <!-- Add more details here as needed -->
        <?php else : ?>
            <p>User not found or not logged in.</p>
        <?php endif; ?>
        <a id="logout-link" href="logout.php">Logout</a><br><br>
        <div class="btn-container">
            <a class="btn" href="update.php">Edit Profile</a><br><br><br>
            <form method="post" action="delete.php">
                <button class="btn btn-delete" type="submit" name="delete">Delete Profile</button>
            </form>
        </div>
    </div>


    <footer id="footer">
        <div class="col col1">
            <h3>One Shot Voting</h3>
            <p>Made with <span style="color: #BA6573;">❤</span> by Jux</p>
            <div class="social">
                <a href="" target="_blank" class="link"><img src="https://assets.codepen.io/9051928/codepen_1.png" alt=""></a>
                <a href="" target="_blank" class="link"><img src="https://assets.codepen.io/9051928/x.png" alt=""></a>
                <a href="" target="_blank" class="link"><img src="https://assets.codepen.io/9051928/youtube_1.png" alt=""></a>
            </div>
            <p style="color: #818181; font-size: smaller">2024 © All Rights Reserved</p>
        </div>
        <div class="col col2">
            <p>About</p>
            <p>Our mission</p>
            <p>Privacy Policy</p>
            <p>Terms of service</p>
        </div>
        <div class="col col3">
            <p>Services</p>
            <p>Products</p>
            <p>Join our team</p>
            <p>Partner with us</p>
        </div>
        <div class="backdrop"></div>
    </footer>
</body>
</html>
