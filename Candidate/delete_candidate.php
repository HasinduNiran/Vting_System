<?php
// Include your database connection script (e.g., dbh.php)
include '../dbh.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the candidate data before deleting (optional, for confirmation)
    $query = "SELECT * FROM candidate WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $candidate_data = mysqli_fetch_assoc($result);

    if ($candidate_data) {
        // Perform the candidate deletion
        $delete_query = "DELETE FROM candidate WHERE id = $id";

        if (mysqli_query($conn, $delete_query)) {
            // Candidate deleted successfully
            echo '<script type="text/javascript">
        window.onload = function () { alert("Candidate Deleted !"); 
            window.location.href = "view_candidate.php";}
        </script>'; // Redirect to a success page
            exit;
        } else {
            // Database deletion failed
            header('Location: delete_error.php'); // Redirect to an error page
            exit;
        }
    } else {
        // Candidate not found
        header('Location: delete_error.php'); // Redirect to an error page
        exit;
    }
} else {
    // Invalid request
    header('Location: delete_error.php'); // Redirect to an error page
    exit;
}
?>
