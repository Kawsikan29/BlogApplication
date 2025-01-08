<?php
include 'db.php'; // Include the database connection

if (isset($_POST['id'])) {
    $postId = $_POST['id'];

    // Prepare SQL query to delete the post
    $query = "DELETE FROM posts WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        // Error preparing the statement
        echo json_encode(['error' => 'Failed to prepare SQL query: ' . mysqli_error($conn)]);
        exit;
    }

    // Bind the ID parameter
    mysqli_stmt_bind_param($stmt, "i", $postId);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Return success message
        echo json_encode(['success' => 'Post deleted successfully.']);
    } else {
        // Return error message
        echo json_encode(['error' => 'Failed to execute query: ' . mysqli_stmt_error($stmt)]);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Post ID is missing.']);
}
?>
