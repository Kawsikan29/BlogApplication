<?php
include 'db.php'; // Include the database connection

// Fetch blog posts if it's an AJAX request
if (isset($_GET['ajax'])) {
    // Fetch all blog posts from the database
    $query = "SELECT * FROM posts ORDER BY timestamp DESC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($post = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                        <p class="card-text"><small class="text-muted">Posted on: <?= htmlspecialchars($post['timestamp']) ?></small></p>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo '<p class="text-center">No blog posts available.</p>';
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>View Blogs</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Blogs</a>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
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

    <div class="container mt-5">
        <div id="postsContainer" class="row mt-3">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <script>
    $(document).ready(function () {
        function loadPosts() {
            $.ajax({
                type: 'GET',
                url: 'viewblog.php',
                data: { ajax: true },
                success: function (response) {
                    $('#postsContainer').html(response); // Show the posts
                },
                error: function () {
                    $('#postsContainer').html('<p class="text-center text-danger">Error loading posts.</p>');
                }
            });
        }

        loadPosts(); // Call the function to load posts initially
    });
</script>

</body>
</html>
