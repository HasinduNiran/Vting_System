<?php

include '../dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM vote WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        echo '<!DOCTYPE html>
<html>
<head>
    <title>Update Vote</title>
    <style>
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
           margin-top: 7%;
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
<nav class="nav">
        <link rel="stylesheet" href="../Header/header.html" />
        <script src="../Header/headjs.js"></script>
          <div class="containerr">
            <h1 class="logo"><a href="index.php">VoteSphere</a></h1>
            <ul>
              <li><a href="index.php">Home</a></li>
              <li><a href="contact_us/contactUs.php">Contact</a></li>
              <li><a href="add_vote/view_vote.php">Vote</a></li>
              <li><a href="login.php">Login</a></li>
        
            </ul>
          </div>
        </nav>
    <h1>Update Vote</h1>

    <form action="update_vote.php" method="post" class="contact-form">
        <input type="hidden" name="vote_id" value="' . $row['id'] . '">
        <div class="form-group">
            <label for="voter">Voter:</label>
            <input type="text" id="voter" name="voter" value="' . $row['voter'] . '" required>
        </div>
        <div class="form-group">
            <label for="candidate">Vote Number:</label>
            <input type="hidden" name="candidate" value="' . $row['candidate'] . '">
            <span>' . $row['candidate'] . '</span>
        </div>
        <div class="form-group">
            <label for="voteDate">Vote Date:</label>
            <input type="date" id="voteDate" name="votedate" value="' . $row['votedate'] . '" required>
        </div>
        <div class="form-group">
            <label for="telephone">Telephone:</label>
            <input type="tel" id="telephone" name="telephone" value="' . $row['telephone'] . '" required>
        </div>
        <div class="form-group">
            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment">' . $row['comment'] . '</textarea>
        </div>
        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" value="' . $row['city'] . '" required>
        </div>
        <div class="form-group">
            <label for="vote">Vote:</label>
            <input type="checkbox" id="vote" name="vote" value="1" ' . ($row['vote'] == 1 ? 'checked' : '') . '>
        </div>
        <button type="submit" name="submit">Update</button>
    </form>
    <footer id="footer">
    <link rel="stylesheet" href="../footer/footcss.css" />
      
      <div class="col col1">
        <h3>One shot Voting</h3>
        
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
</html>';
    } else {
        echo 'Vote entry not found.';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote_id'])) {
    $id = $_POST['vote_id'];
    $voter = mysqli_real_escape_string($conn, $_POST['voter']);
    // You can remove the line below to prevent the user from updating the candidate field
    // $candidate = mysqli_real_escape_string($conn, $_POST['candidate']); 
    $voteDate = mysqli_real_escape_string($conn, $_POST['votedate']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $vote = isset($_POST['vote']) ? 1 : 0;

    $sql = "UPDATE vote SET voter='$voter', votedate='$voteDate', telephone='$telephone', comment='$comment', city='$city', vote=$vote WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: view_vote.php');
    } else {
        echo 'Failed to update vote.';
    }
}

mysqli_close($conn);

?>
