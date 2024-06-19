<?php
include '../dbh.php';
session_start();
$email = $_SESSION['email']; // Fetch email from session

if (isset($_POST['submit'])) {
    // Retrieve form data and sanitize
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $msg = mysqli_real_escape_string($conn, $_POST['message']);

    // Simple validation
    if (empty($name) || empty($email) || empty($msg)) {
        echo '<script type="text/javascript">
            window.onload = function () { alert("Please fill in all fields."); }
            </script>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script type="text/javascript">
            window.onload = function () { alert("Invalid email format."); }
            </script>';
    } else {
        // Insert data into the database
        $sql = "INSERT INTO `contact` (`name`,`email`,`message`)
        VALUES('$name', '$email', '$msg')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '<script type="text/javascript">
            window.onload = function () { alert("Data Inserted !"); 
                window.location.href = "viewMyFeedback.php";}
            </script>';
        } else {
            echo "Failed";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback</title>
    <style>
        /* CSS for the navigation bar (header) */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .containerr {
            max-width: 1200px;
            margin: 0 auto;
        }

        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #222;
            transition: top 0.3s;
            font-family: system-ui, sans-serif;
        }

        .nav .containerr {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            transition: all 0.3s ease-in-out;
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

        .nav.active {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .nav.active a {
            color: #222;
        }

        .nav.active .containerr {
            padding: 10px 0;
        }

        .nav a.current, .nav a:hover {
            color: #D80032;
            font-weight: bold;
        }

        /* Feedback form CSS */
        body {
            background-image: url("../image/fullbg.jpg");
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin: 20px 0;
            background-color: rgb(27, 22, 22);
            width: 60%;
            height: 50px;
            border-radius: 8px;
            margin-left: 0%;
            margin-top: 10%;
       
        }

        .contact-form {
            width: 70%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin: 10px 0;
        }

        label {
            display: block;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: vertical;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <nav class="nav">
        <link rel="stylesheet" href="../Header/headcss.css?v=1" />
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

    <!-- Feedback form -->
    <h2>Feedback</h2>

    <div class="contact-form">
        <form action="contactUs.php" method="post" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
    <label for="email">Email:</label>
    <!-- Set the value to the session email and make it read-only -->
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
</div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;

            // Check if any field is empty
            if (name.trim() === "" || email.trim() === "" || message.trim() === "") {
                alert("Please fill in all fields.");
                return false;
            }

          // Check if name contains only letters and spaces
var nameRegex = /^[a-zA-Z\s]+$/;
if (!nameRegex.test(name)) {
    alert("Name must contain only letters.");
    return false;
}


            // Email validation (built-in HTML5)
            if (!document.getElementById("email").checkValidity()) {
                alert("Invalid email format.");
                return false;
            }

            return true;
        }
    </script>



<footer id="footer">
    <link rel="stylesheet" href="../footer/footcss.css" />
      
      <div class="col col1">
        <h3>VoteSphere</h3>
        <p>Made with <span style="color: #BA6573;">❤</span> by Jux</p>
        <div class="social">
          <a href="" target="_blank" class="link"><img src="https://assets.codepen.io/9051928/codepen_1.png" alt="" /></a>
          <a href="" target="_blank" class="link"><img src="https://assets.codepen.io/9051928/x.png" alt="" /></a>
          <a href="" target="_blank" class="link"><img src="https://assets.codepen.io/9051928/youtube_1.png" alt="" /></a>
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
