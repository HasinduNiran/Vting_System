<?php
// Include your database connection file
include '../dbh.php';

// Check if the vote id is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM vote WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters and execute the statement
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Redirect back to the view votes page after successful deletion
            header("Location: view_vote.php");
            exit();
        } else {
            echo "Error: Unable to delete vote.";
        }
    } else {
        echo "Error: Unable to prepare delete statement.";
    }

    // Close statement
    $stmt->close();
} else {
    // If no vote id is provided in the URL, display an error message
    echo "Error: Vote ID not provided.";
}

// Close connection
$conn->close();
?>
