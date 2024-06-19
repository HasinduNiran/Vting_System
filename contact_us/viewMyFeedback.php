<!DOCTYPE html>
<html>
<head>
    <title>Feedback Details</title>
    <link rel="stylesheet" href="../Header/headcss.css">
    <link rel="stylesheet" href="../footer/footcss.css">
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
            
            background-position: center;
        }

        h2 {
            background-color: rgb(60, 56, 54);
            width: 50%;
            height: 100px;
            text-align: center;
            margin: 20px auto;
            color: white;
            border-radius: 8px;
            font-size: 50px;
        }

        table {
            width: 80%;
            height: 20%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #171616;
            padding: 10px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        a:hover {
            text-decoration: underline;
        }
        
    /* Styles for update and delete links */
    .update-link, .delete-link {
        text-decoration: none;
        color: #007bff; /* Blue color */
        margin-right: 5px; /* Add some spacing between links */
    }

    .update-link:hover, .delete-link:hover {
        text-decoration: underline;
    }

    .delete-link {
        color: #dc3545; /* Red color */
    }
    </style>
</head>
<body>
<nav class="nav">
    <link rel="stylesheet" href="../Header/headcss.css" />
    <script src="../Header/headjs.js"></script>
    <div class="containerr">
            <h1 class="logo"><a href="index.php">One Shot Voting</a></h1>
            <ul>
              <li><a href="../dashboard.php">Home</a></li>
              <li><a href="login.php">Login</a></li>
              <li><a href="sign_up.php">Signup</a></li>
        
            </ul>
          </div>
</nav>
<hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr><hr>
<a href="../dashboard.php">Home</a>
<h2>Feedback Details</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Actions</th>
    </tr>
    <?php
    // Include your database connection script (e.g., dbh.php)
    include '../dbh.php';
    session_start();
    $email = $_SESSION['email']; // Fetch email from session

    // Check if the 'id' parameter is set in the URL
    if(isset($_GET['id'])) {
        // Sanitize the ID input to prevent SQL injection
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        // Fetch data for the specific contact based on their ID
        $query = "SELECT * FROM contact WHERE email = '$email'"; // Use single quotes around $email
        $result = mysqli_query($conn, $query);

        // Check if a record is found
        if(mysqli_num_rows($result) > 0) {
            // Fetch the record
            $row = mysqli_fetch_assoc($result);

            // Display the contact's details
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td><input type="text" value="' . $row['email'] . '" readonly></td>'; // Email field as read-only input
            echo '<td>' . $row['message'] . '</td>';
            echo '<td>
                    <a class="update-link" href="updatec.php?id=' . $row['id'] . '">Update</a> |
                    <a  class="delete-link" href="deletec.php?id=' . $row['id'] . '">Delete</a>
                  </td>';
            echo '</tr>';
        } else {
            // If no record is found, display a message
            echo '<tr><td colspan="5">No record found for this ID.</td></tr>';
        }
    } else {
        // If 'id' parameter is not set, display all contacts
        $query = "SELECT * FROM contact WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['message'] . '</td>';
            echo '<td>
                    <a class="update-link" href="updatec.php?id=' . $row['id'] . '">Update</a> |
                    <a class="delete-link" href="deletec.php?id=' . $row['id'] . '">Delete</a>
                  </td>';
            echo '</tr>';
        }
    }
    ?>
</table>
<footer id="footer">
    <link rel="stylesheet" href="../footer/footcss.css" />
    <div class="col col1">
        <h3>One Shot Voting</h3>
       
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
