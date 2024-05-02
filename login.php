<?php
include 'dbh.php';


$Invalid = "";
if (isset($_POST['btnlogin'])) {
    if (isset($_POST['btnlogin'])){

        $email = mysqli_real_escape_string($conn,$_POST['user_email']);
        $pass = mysqli_real_escape_string($conn,$_POST['user_password']);

        $select = mysqli_query($conn,"SELECT * from `user` WHERE email = '$email'
        AND password = '$pass'");

    if (mysqli_num_rows($select) > 0) {
        session_start();
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $Invalid = "Invalid Email or Password!";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/Login_SK.css">
    <link rel = "stylesheet" href = "css/homepage.css">
    <script src="https://kit.fontawesome.com/b3ca95fff7.js" crossorigin="anonymous"></script>
    <title>Bizen/Login page</title>
</head>
<body>

    <div class = "fromebox">
    <p class = "errorbox"> <?php echo $Invalid?></p>
    <h1 class = "login">Log In</h1>

    <form class = "form1" method = "post" action = "login.php">

            <div class = "input">
            <i class="fa-solid fa-envelope"></i>
                <input type = "email" placeholder  = "Enter E-mail" name = "user_email">
            </div>

            
            <div class = "input">
            <i class="fa-solid fa-lock"></i>
                <input type = "password" placeholder  = "Enter password" id = "firstpas" name = "user_password">
            </div>

            <button  onclick = "btnclick ()" name = "btnlogin">Log In </button>

            <p class = "p1">Don't have an account? <a class = "click" href = "Sign_up.php">Sign Up</a></P>


    </div>

</body>

</html>