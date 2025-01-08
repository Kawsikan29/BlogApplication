<?php
include 'db.php'; // Connect to the database

$error = '';//insert failure
$success = '';//insert success

// Check if it's an AJAX request and handle accordingly
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    // Get the title and content from the POST request
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Validate inputs
    if (empty($title) || empty($content)) {
        $error = 'Both title and content are required.';
    } else {
        $query = "INSERT INTO posts (title, content, timestamp) VALUES (?, ?, NOW())";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "ss", $title, $content);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                $success = 'Blog post created successfully!';
            } else {
                $error = 'Error creating blog post: ' . mysqli_error($conn);
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            $error = 'Database error: ' . mysqli_error($conn);
        }
    }

    // Return a response in JSON format
    echo json_encode(['error' => $error, 'success' => $success]);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Blog</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="createblog.php" tabindex="-1" aria-disabled="true">Create Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="viewblog.php" tabindex="-1" aria-disabled="true">View Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="deleteblog.php" tabindex="-1" aria-disabled="true">Remove Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    

    <div>
        <div class="container m-auto mt-3 row">
            <div class="col-8">
                <h2>Create Blog Post</h2>

                <form id="createPostForm">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>

                <div id="message"></div> <!-- To show success or error message -->

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Handle form submission via AJAX
            $('#createPostForm').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = $(this).serializeArray();
                formData.push({ name: 'ajax', value: true }); // Add the 'ajax' flag

                // Send AJAX request
                $.ajax({
                    type: 'POST',
                    url: 'createblog.php', // Send request to the same page
                    data: formData,
                    dataType: 'json',
                    success: function (response) {
                        // Display success or error message
                        if (response.success) {
                            $('#message').html('<div class="alert alert-success">' + response.success + '</div>')
                             // Clear the form fields after successful submission
                            $('#createPostForm')[0].reset();
                        } else if (response.error) {
                            $('#message').html('<div class="alert alert-danger">' + response.error + '</div>');
                        }
                    },
                    error: function () {
                        // Handle AJAX errors
                        $('#message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
