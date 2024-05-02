<?php
include "dbh.php";
$success = "";
if (isset($_POST["submit"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    if ($password == $confirmpassword) {
        $query = "INSERT INTO `user` (fname, lname, phone, email, password) VALUES ('$fname', '$lname', '$phone', '$email',  '$password')";
        $result = mysqli_query($conn, $query);
        $success = "<script>alert('Registration Successful');</script>";
        // = "Registration Successful";
        header('Location: login.php');
    } else {
        $success = "Password Does Not Match";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signIn.css">
    <link rel="stylesheet" href="homepage.css">
    <title>Sign up</title>
</head>

<body>
    
    <div class="signbox">
        <p class="success"> <?php echo $success ?></p>
        <center>
            <h1 class="SignIn">Sign In</h1>
        </center>

        <form class="signinbox" method="post" action="" autocomplete="off" id="registrationForm">
            <label>First Name</label><br>
            <input type="text" placeholder="First Name" name="fname"><br><br>

            <label>Last Name</label><br>
            <input type="text" placeholder="Last Name" name="lname"><br><br>

            <label>TP No</label><br>
            <input type="text" placeholder="077-1234567" name="phone"><br><br>

            <label>Email</label><br>
            <input type="email" placeholder="example@email.com" name="email"><br><br>

            <label>Password</label><br>
            <input type="password" placeholder="********" name="password"><br><br>

            <label>Confirm Password</label><br>
            <input type="password" placeholder="********" name="confirmpassword"><br><br>

            <button type="submit" name="submit">Submit</button>
        </form>

        <script>
                        document.getElementById("registrationForm").addEventListener("submit", function(event) {
                            var password = document.getElementById("password").value;
                            var confirmPassword = document.getElementById("confirmPassword").value;

                            if (password !== confirmPassword) {
                                // Display an alert if passwords do not match
                                alert("Passwords do not match.");
                                window.location.href = "addadmin.php";
                                event.preventDefault(); // Prevent the form from submitting
                            }
                        });
                    </script>

    </div>


</body>

</html>