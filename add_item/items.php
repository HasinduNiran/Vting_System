<!DOCTYPE html>
<html>
<head>
    <title>Item List</title>
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
    background-image: url('../feedback/bg.webp');
    background-size: cover;
    background-repeat: no-repeat;
}

h1 {
    text-align: center;
    margin: 20px 0;
    color: #333;
    background-color: brown;
    color: #ccc;
    border-radius: 8px;
    margin-left: 400px;
    width: 50%;
    height: 100px;
    font-size: 60px;
}

table {
    border-collapse: collapse;
    width: 90%;
    margin: 20px 20px;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: center;
    font-size: 30px;
    font-weight: 500;
}

th {
    background-color: #007bff;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e0e0e0;
    transition: background-color 0.3s;
}

td img {
    display: block;
    max-width: 100px;
    height: auto;
    margin: 0 auto;
}

td:last-child {
    text-align: center;
}

a {
    display: inline-block;
    padding: 8px 16px;
    margin: 5px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #0056b3;
}
.delete{
    background-color: red;
}

    </style>
    
</head>
<body>
    <a href="../dashboard.php">Home</a>
    <h1>Item List</h1>
    

    <table>
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Replace with your database connection script
            include '../dbh.php';

            // Fetch items from the database
            $query = "SELECT * FROM item";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['code'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>$" . $row['price'] . "</td>";
                echo "<td>" . $row['discription'] . "</td>";
                echo '<td><img src="' . $row['img'] . '" alt="Item Image" width="100"></td>';
                
                echo '<td><a href="update.php?id=' . $row['itemId'] . '">Update</a></td>';
                echo '<td><a href="delete.php?id=' . $row['itemId'] . '" class="delete">Delete</a></td>';
                echo "</tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
