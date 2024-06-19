<!DOCTYPE html>
<html>
<head>
    <title>View Votes</title>
    <style>
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
           margin-top: 10%;
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
            <h1 class="logo"><a href="index.php">VoteSphere</a></h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contact_us/contactUs.php">Contact</a></li>
                <li><a href="add_vote/view_vote.php">Vote</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </div>
    </nav>
    <h2>View Votes</h2>

    <table>
        <thead>
            <tr>
                <th>Voter</th>
                <th>Vote Number</th>
                <th>Vote Date</th>
                <th>Telephone</th>
                <th>Comment</th>
                <th>City</th>
                <th>Vote</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include your database connection file
            include '../dbh.php';

            // Query to select all votes
            $sql = "SELECT * FROM vote";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["voter"] . "</td>";
                    echo "<td>" . $row["candidate"] . "</td>";
                    echo "<td>" . $row["votedate"] . "</td>";
                    echo "<td>" . $row["telephone"] . "</td>";
                    echo "<td>" . $row["comment"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . ($row["vote"] == 1 ? 'Yes' : 'No') . "</td>";
                    echo "<td>";
                    echo "<a href='update_vote.php?id=" . $row['id'] . "' class='action-btn update-btn'>Update</a>";
                    echo "<a href='delete_vote.php?id=" . $row['id'] . "' class='action-btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this vote?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                
            } else {
                echo "<tr><td colspan='8'>No votes found</td></tr>";
            }
            ?>
        </tbody>
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
