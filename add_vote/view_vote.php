<!DOCTYPE html>
<html>
<head>
    <title>View Votes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            background-image: url('../image/dg.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .action-btn {
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-btn {
            background-color: #ff5757;
            color: #fff;
        }

        .update-btn {
            background-color: #007bff;
            color: #fff;
        }

        .action-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>View Votes</h1>

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
</body>
</html>
