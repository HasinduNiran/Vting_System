<!DOCTYPE html>
<html>
<head>
    <title>Feedback Details</title>
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
    <h1>Feedback Details</h1>
    
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

        // Check if the 'id' parameter is set in the URL
        if(isset($_GET['id'])) {
            // Sanitize the ID input to prevent SQL injection
            $id = mysqli_real_escape_string($conn, $_GET['id']);

            // Fetch data for the specific contact based on their ID
            $query = "SELECT * FROM contact WHERE id = $id";
            $result = mysqli_query($conn, $query);

            // Check if a record is found
            if(mysqli_num_rows($result) > 0) {
                // Fetch the record
                $row = mysqli_fetch_assoc($result);

                // Display the contact's details
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['message'] . '</td>';
                echo '<td>
                        <a href="updatec.php?id=' . $row['id'] . '">Update</a> |
                        <a href="deletec.php?id=' . $row['id'] . '">Delete</a>
                      </td>';
                echo '</tr>';
            } else {
                // If no record is found, display a message
                echo '<tr><td colspan="5">No record found for this ID.</td></tr>';
            }
        } else {
            // If 'id' parameter is not set, display all contacts
            $query = "SELECT * FROM contact";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['message'] . '</td>';
                echo '<td>
                        <a href="updatec.php?id=' . $row['id'] . '">Update</a> |
                        <a href="deletec.php?id=' . $row['id'] . '">Delete</a>
                      </td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</body>
</html>
