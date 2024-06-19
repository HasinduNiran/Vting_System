<!DOCTYPE html>
<html>
<head>
    <title>Voting</title>
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
       
input[type="checkbox"]#vote {
    margin-left: 10px;
   
    width: 20px; 
    height: 20px; 
    
}


input[type="date"]#voteDate {
    
   
    padding: 8px;
    border: 1px solid #ccc; 
    border-radius: 4px; 
}


input[type="tel"]#telephone {
 
    
    padding: 8px; 
    border: 1px solid #ccc; 
    border-radius: 4px;
}


    </style>
</head>
<body>
<nav class="nav">
        <link rel="stylesheet" href="../Header/header.html" />
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
    

    <form action="add_vote.php" method="post" class="contact-form">
    <h2>Add New Vote</h2>
        <label for="voter">Voter:</label>
        <input type="text" id="voter" name="voter" required>

        <label for="candidate">Vote Number:</label>
        <select id="candidate" name="candidate" required>
            <option value="1">01</option>
            <option value="2">02</option>
            <option value="3">03</option>
            <option value="4">04</option>
            <option value="5">05</option>
            <!-- Add more candidates as needed -->
        </select>

        <label for="voteDate">Vote Date:</label>
        <input type="date" id="voteDate" name="voteDate" required>

        <label for="telephone">Telephone:</label>
        <input type="tel" id="telephone" name="telephone" required>

        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment"></textarea>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="vote">Vote:</label>
        <input type="checkbox" id="vote" name="vote" value="1">

        <button type="submit" name="submit">Add Vote</button>
    </form>
    
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
include '../dbh.php'; // Make sure to include your database connection here

if (isset($_POST['submit'])) {
    // Check if all required fields are set
    if (
        isset($_POST['voter']) && 
        isset($_POST['candidate']) && 
        isset($_POST['voteDate']) && 
        isset($_POST['telephone']) && 
        isset($_POST['city'])
    ) {
        // Sanitize and validate input
        $voter = $_POST['voter'];
        $candidate = $_POST['candidate'];
        $voteDate = $_POST['voteDate'];
        $telephone = $_POST['telephone'];
        $comment = isset($_POST['comment']) ? $_POST['comment'] : null; // Comment is optional
        $city = $_POST['city'];
        $vote = isset($_POST['vote']) ? 1 : 0;

        // Insert data into the database
        $sql = "INSERT INTO vote (voter, candidate, voteDate, telephone, comment, city, vote) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $voter, $candidate, $voteDate, $telephone, $comment, $city, $vote);

    
        // Execute the statement
if ($stmt->execute()) {
    echo "Vote added successfully!";
    header("Location: ../dashboard.php"); // Redirect to dashboard.php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


        // Close statement
        $stmt->close();
    } else {
        // If required fields are not set, display an error message
        echo "Please fill in all required fields.";
    }

    // Close connection
    $conn->close();
}
?>
