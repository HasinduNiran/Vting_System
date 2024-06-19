<!DOCTYPE html>
<html>
<head>
    <title>Update Contact</title>
    <style>
        /* Reset default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-image: url('../image/fullbg.jpg');
    background-size: cover;
    background-repeat:no-repeat;
    background-position: center;
    
}

h2 {
    text-align: center;
    margin: 20px 0;
    color: #333;
    margin-top: 10%;
}

form {
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
select,
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

/* Optional: Add a background image or texture */


    </style>
</head>
<body>
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
       
    <h2>Update Contact</h2>

    <?php
    // Include your database connection script (e.g., dbh.php)
    include '../dbh.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the specific feedback entry from the database
        $query = "SELECT * FROM contact WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo '<form action="updatec.php" method="post">
                <input type="hidden" name="feedback_id" value="' . $row['id'] . '">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="' . $row['name'] . '" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="' . $row['email'] . '" required>
                </div>

                

                <div class="form-group">
                    <label for="comments">Message:</label>
                    <textarea id="comments" name="message" rows="4" required>' . $row['message'] . '</textarea>
                </div>

                <button type="submit" name ="submit">Update </button>
            </form>';
        } else {
            echo 'Feedback entry not found.';
        }
    }
    ?>
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

<?php
include '../dbh.php';
if (isset($_POST['submit'])) {
    $id = $_POST['feedback_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];
    

    $sql = "UPDATE contact SET name='$name', email='$email', message='$msg' WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo '<script type="text/javascript">
        window.onload = function () { alert("Data Updated !"); 
            window.location.href = "viewc.php";}
        </script>';
    } else {
        echo "Failed";
    }
}
?>
