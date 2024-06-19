<!DOCTYPE html>
<html>
<head>
    <title>Battle Details</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
          background-image: url("../image/fullbg.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    background-size: cover;
        }

        h2 {
            background-color: #168382;
            width: 50%;
            height: 100px;
            margin-top: 10%;
            text-align: center;
            color: white;
            border-radius: 8px;
            position: relative;
            font-size: 50px;
            margin-left: 10%;
        }

        table {
            width: 80%;
            border-collapse: collapse;
           margin-left: 10%;
            margin-top: 5%;
        }

        th, td {
            border: 1px solid #625f5f;
            padding: 10px;
            text-align: left;

        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #2a2929;
            color: #fff;
        }
        td.actions a {
    display: inline-block;
    padding: 5px 10px;
    background-color: #4CAF50; /* Green */
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 5px;
}

td.actions a:hover {
    background-color: #45a049; /* Darker green */
}

td.actions a.delete {
    background-color: #f44336; /* Red */
}

td.actions a.delete:hover {
    background-color: #da190b; /* Darker red */
}

      

        

        /* Optional: Add a background image or texture */
        

    </style>
</head>
<body>
<nav class="nav">
        <link rel="stylesheet" href="../Header/headcss.css" />
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
    <a href="../adminDashboard.php">Home</a>
    <h2>Battle Details</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Battle Name</th>
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php
        // Include your database connection script (e.g., dbh.php)
        include '../dbh.php';

        // Fetch battle details from the database
        $query = "SELECT * FROM battle";
        $result = mysqli_query($conn, $query);

        // Check if any battles are found
        if(mysqli_num_rows($result) > 0) {
            // Loop through each row and display battle details
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['player1'] . '</td>';
                echo '<td>' . $row['player2'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td td class="actions">
                        <a href="updateBattle.php?id=' . $row['id'] . '">Update</a> |
                        <a class="delete" href="deleteBattle.php?id=' . $row['id'] . '">Delete</a>
                      </td>';
                echo '</tr>';
            }
        } else {
            // If no battles are found, display a message
            echo '<tr><td colspan="6">No battles found.</td></tr>';
        }
        ?>
    </table>
   
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
