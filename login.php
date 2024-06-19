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
        $_SESSION['email'] = $row['email'];
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
<body>
    <nav class="nav">
        <link rel="stylesheet" href="Header/headcss.css" />
        <script src="Header/headjs.js"></script>
        <div class="containerr">
            <h1 class="logo"><a href="index.php">One Shot Voting</a></h1>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="sign_up.php">Signup</a></li>
        
            </ul>
          </div>
        </nav>
    <div class="contain">

        <p class="errorbox"> <?php echo $Invalid?></p>
        <div class="login">
            <form action="login.php" method="post">
                <h1>Welcome Back!</h1>
                <small>Login to your account and start connecting with the world. Your journey begins here.</small>
                <label for="email">Email</label>
                <input placeholder="Enter Email" type="email" name="user_email" id="">
                <label for="pass">Password</label>
                <input placeholder="Enter Password" type="password" name="user_password" id="firstpas">
                <div class="mor">
                    <input class="check" type="checkbox"><label for="check">Remember Me</label>
                    <a href="">Forgot Password?</a>
                </div>
                <input class="log" type="submit" name="btnlogin" value="Login" id="">

               
            </form>
        </div>

        <div class="image">
            <h1>New here? Sign up and unlock amazing features!</h1>
            <!-- <button class="sign" href="sign_up.php">Sign Up</button> -->
        </div>

    </div>

    <script>
      feather.replace()
    </script>
    
</body>
</html>
