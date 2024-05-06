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
            background-image: url("./../image/sky.png");
            margin: 0;
            padding: 0;
        }

        h1 {
            width: 50%;
            height: 100px;
            text-align: center;
            margin: 20px auto;
            color: black;
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

        /* Header styles */
        .header {
            background: #7bbcf1;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo img {
            width: 150px;
            height: 70px;
        }

        .navbar {
            margin-left: auto; /* Shifts the navbar to the right */
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            padding: 8px 16px; /* Padding for the button */
            border-radius: 5px; /* Rounded corners */
            background-color: #4CAF50; /* Green background */
            transition: background-color 0.3s; /* Smooth transition */
        }

        .navbar a:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .menu-btn {
            color: #fff;
            font-size: 24px;
            cursor: pointer;
        }

    </style>
</head>
<body>

<header class="header">
    <a href="#" class="logo">
        <img src="../image/pngegg.png" alt="">
    </a>

    <nav class="navbar">
        <a href="../index.html" class="btn">Home</a>
    </nav>

    <div id="menu-btn" class="menu-btn fas fa-bars"></div>
</header>

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
