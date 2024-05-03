<?php
// Include the database connection file
include 'dbh.php';

// Initialize a variable to store error message
$Invalid = "";

// Check if the login form is submitted
if (isset($_POST['btnlogin'])) {
    // Sanitize and store the entered email and password
    $email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $pass = mysqli_real_escape_string($conn, $_POST['user_password']);

    // Check if the entered email and password match the specified credentials
    if ($email === "OneShotAdmin@gmail.com" && $pass === "OneShot2002") {
        // Redirect to another dashboard page
        header('Location: adminDashboard.php');
        exit;
    }

    // Query the database to select user with provided email and password
    $select = mysqli_query($conn, "SELECT * from `user` WHERE email = '$email' AND password = '$pass'");

    // Check if the query returns any row (user found)
    if (mysqli_num_rows($select) > 0) {
        // Start a session
        session_start();
        // Fetch the user row from the result
        $row = mysqli_fetch_assoc($select);
        // Store user's ID in session variable
        $_SESSION['user_id'] = $row['id'];
        // Redirect to dashboard page
        header('Location: dashboard.php');
        exit;
    } else {
        // Set error message for invalid email or password
        $Invalid = "Invalid Email or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Login_SK.css">
    <link rel="stylesheet" href="css/homepage.css">
    <script src="https://kit.fontawesome.com/b3ca95fff7.js" crossorigin="anonymous"></script>
    <title>One shot/Login page</title>
</head>
<body>

    <div class="fromebox">
    <p class="errorbox"> <?php echo $Invalid?></p>
    <h1 class="login">Log In</h1>

    <form class="form1" method="post" action="login.php">

            <div class="input">
            <i class="fa-solid fa-envelope"></i>
                <input type="email" placeholder="Enter E-mail" name="user_email">
            </div>

            
            <div class="input">
            <i class="fa-solid fa-lock"></i>
                <input type="password" placeholder="Enter password" id="firstpas" name="user_password">
            </div>

            <button name="btnlogin">Log In</button>

            <p class="p1">Don't have an account? <a class="click" href="Sign_up.php">Sign Up</a></P>


    </div>

</body>

</html>
