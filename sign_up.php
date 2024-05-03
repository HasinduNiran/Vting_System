<?php
include "dbh.php"; // Including the database connection file
$success = ""; // Initialize a variable to store success message
if (isset($_POST["submit"])) { // Check if the form is submitted
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];

    if ($password == $confirmpassword) { // Check if passwords match
        // SQL query to insert data into database
        $query = "INSERT INTO `user` (firstname, lastname,dob, email, phone, password) VALUES ('$firstname', '$lastname','$dob', '$email', '$phone',  '$password')";
        $result = mysqli_query($conn, $query); // Execute the query
        $success = "<script>alert('Registration Successful');</script>"; // Set success message
        // Redirect user to login page after successful registration
        header('Location: login.php');
    } else {
        $success = "Password Does Not Match"; // Set error message if passwords don't match
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
    <title>Register</title>
</head>

<body>
    
    <div class="signbox">
        <!-- Display success or error message -->
        <p class="success"> <?php echo $success ?></p>
        <center>
            <h1 class="SignIn">Register</h1>
        </center>

        <form class="signinbox" method="post" action="" autocomplete="off" id="registrationForm">
            <!-- Form fields -->
            <label>First Name</label><br>
            <input type="text" placeholder="First Name" name="firstname"><br><br>

            <label>Last Name</label><br>
            <input type="text" placeholder="Last Name" name="lastname"><br><br>

            <label>Date of Birthday</label><br>
            <input type="date" placeholder="Birthday" name="dob"><br><br>

            <label>Telephone No</label><br>
            <input type="text" placeholder="077-1234567" name="phone"><br><br>

            <label>Email</label><br>
            <input type="email" placeholder="example@email.com" name="email"><br><br>

            <label>Password</label><br>
            <input type="password" placeholder="********" name="password"><br><br>

            <label>Confirm Password</label><br>
            <input type="password" placeholder="********" name="confirmpassword"><br><br>

            <button type="submit" name="submit">Submit</button>
        </form>

        <!-- JavaScript to validate password confirmation -->
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
