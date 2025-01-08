<?php
include 'db.php'; // Connect to the database

// Set error reporting to see if any issues occur
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Fetch posts from the database
$query = "SELECT * FROM posts ORDER BY id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    // If there's a query error, return the error
    echo json_encode(['error' => 'Database query failed: ' . mysqli_error($conn)]);
    exit();
}

// Prepare an array to store the posts
$posts = [];

if (mysqli_num_rows($result) > 0) {
    // Fetch each post and add it to the $posts array
    while ($post = mysqli_fetch_assoc($result)) {
        $posts[] = [
            'title' => htmlspecialchars($post['title']),
            'content' => htmlspecialchars($post['content']),
            'timestamp' => htmlspecialchars($post['timestamp'])
        ];
    }

    // Return the posts as a JSON response
    echo json_encode($posts);
} else {
    // If no posts are found, return an empty array
    echo json_encode([]);
}
?>