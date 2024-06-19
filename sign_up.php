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

    // Validations
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($dob) || empty($password) || empty($confirmpassword)) {
        $success = "Please fill in all fields.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $firstname) || !preg_match("/^[a-zA-Z]+$/", $lastname)) {
        $success = "First name and last name should contain only letters.";
    } elseif (strtotime($dob) >= time()) {
        $success = "Please enter a valid date of birth.";
    } elseif (!preg_match("/^\d{10}$/", $phone)) {
        $success = "Phone number should be 10 digits.";
    } elseif ($password !== $confirmpassword) {
        $success = "Passwords do not match.";
    } else {
        // SQL query to insert data into database
        $query = "INSERT INTO `user` (firstname, lastname, dob, email, phone, password) VALUES ('$firstname', '$lastname', '$dob', '$email', '$phone',  '$password')";
        $result = mysqli_query($conn, $query); // Execute the query
        $success = "<script>alert('Registration Successful');</script>"; // Set success message
        // Redirect user to login page after successful registration
        header('Location: login.php');
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
    <div class="image">
        <img src="image/signlogo.png" alt="" width="450px" height="450px">
    </div>
    
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
            <input type="password" placeholder="********" name="password" id="password"><br><br>

            <label>Confirm Password</label><br>
            <input type="password" placeholder="********" name="confirmpassword" id="confirmPassword"><br><br>

            <button type="submit" name="submit">Submit</button>
        </form>

        <!-- JavaScript to validate password confirmation -->
        <script>
            document.getElementById("registrationForm").addEventListener("submit", function(event) {
                var password = document.getElementById("password").value;
                var confirmPassword = document.getElementById("confirmPassword").value;
                var firstName = document.getElementsByName("firstname")[0].value;
                var lastName = document.getElementsByName("lastname")[0].value;
                var dob = document.getElementsByName("dob")[0].value;
                var phone = document.getElementsByName("phone")[0].value;
                var email = document.getElementsByName("email")[0].value;

                if (!firstName || !lastName || !dob || !phone || !email || !password || !confirmPassword) {
                    // Display an alert if any field is empty
                    alert("Please fill in all fields.");
                    event.preventDefault(); // Prevent the form from submitting
                } else if (password !== confirmPassword) {
                    // Display an alert if passwords do not match
                    alert("Passwords do not match.");
                    event.preventDefault(); // Prevent the form from submitting
                }
            });
        </script>

    </div>


</body>

</html>
