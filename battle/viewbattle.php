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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: orangered;
            width: 50%;
            height: 100px;

            text-align: center;
            margin: 20px auto;
            color: white;
            border-radius: 8px;
            font-size: 50px;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
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

        a {
            display: inline-block;
            padding: 8px 16px;
            margin: 5px;
            background-color: red;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Optional: Add a background image or texture */
        body {
            background-image: url('3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

    </style>
</head>
<body>
    <a href="../dashboard.php">Home</a>
    <h1>Battle Details</h1>
    
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
                echo '<td>
                        <a href="updateBattle.php?id=' . $row['id'] . '">Update</a> |
                        <a href="deleteBattle.php?id=' . $row['id'] . '">Delete</a>
                      </td>';
                echo '</tr>';
            }
        } else {
            // If no battles are found, display a message
            echo '<tr><td colspan="6">No battles found.</td></tr>';
        }
        ?>
    </table>
</body>
</html>
