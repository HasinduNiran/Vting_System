<?php
session_start(); // Make sure to start the session
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}


include '../dbh.php';

if (isset($_SESSION['user_id'])) {
    // Retrieve user details from the database based on the user's ID
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM `user` WHERE id = $userId";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Now you can access user details like $user['fmname'], $user['lname'], etc.
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            background-image: url("profileBack.png");
            
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        h1 {
            font-size: 50px;
            font-weight: 600;
            text-align: left;
            color: #442f05;
            border-bottom: 3px solid silver;
        }

        p {
            font-size: 35px;
            margin-bottom: 20px;
            color: #555;
        }

        .btn-container {
            margin-top: 20px;
            display: flex; /* Align buttons in a row */
            justify-content: space-between; /* Add space between buttons */
        }

        .btn,
        a {
            padding: 8px 16px; /* Adjust padding */
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 28px; /* Reduce font size */
        }

        .btn:hover,
        a:hover {
            background-color: #1156b3;
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
            position: absolute;
            top: 10px;
            left: 100px;
        }

        .imgcon {
            position: absolute;
            top: -50px;
            left: 600px;
        }

        img {
            position: relative;
            left: 180px;
            top: 250px;
        }
    </style>

</head>
<body>

    
    <div class="detailscon">
    <?php if (isset($user)) : ?>
        <h1>Welcome<br> </h1>
        <p>Name: <?php echo $user['firstname']; ?> <?php echo $user['lastname']; ?></p>
        <p>Email: <?php echo $user['email']; ?></p>
        <p>Birthday: <?php echo $user['dob']; ?></p>
        <p>Phone: <?php echo $user['phone']; ?></p>
        <p>Password: <?php echo $user['password']; ?></p>
        <!-- Add more details here as needed -->
    <?php else : ?>
        <p>User not found or not logged in.</p>
    <?php endif; ?>
    
    <div class="btn-container">
    <a href="logout.php">Logout</a>
        <a class="btn" href="update.php">Edit Profile</a><br><br><br>
        <form method="post" action="delete.php">
            <button class="btn btn-delete" type="submit" name="delete">Delete Profile</button>
        </form>
    </div>
    </div>
    <div class="imgcon">
        <img src="viewback.png" alt="" width="500px" >
    </div>
   
</body>
</html>
