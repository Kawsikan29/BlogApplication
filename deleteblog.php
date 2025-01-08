<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Delete Blog Posts</title>
</head>
<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Blog</a>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" href="createblog.php">Create Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="viewblog.php">View Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="deleteblog.php">Delete Blogs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    

    <div class="container mt-5">
        <div id="message"></div>
        <div class="row" id="postsContainer">
            <?php
            // Fetch all 
            $query = "SELECT * FROM posts ORDER BY timestamp DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0):
                while ($post = mysqli_fetch_assoc($result)):
            ?>
            <div class="col-md-6" id="post-<?= $post['id'] ?>">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($post['title']) ?></h5>
                        <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                        <p class="card-text"><small class="text-muted">Posted on: <?= htmlspecialchars($post['timestamp']) ?></small></p>
                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $post['id'] ?>">
                           Delete
                        </button>
                    </div>
                </div>
            </div>
            <?php
                endwhile;
            else:
            ?>
            <p class="text-center">No blog posts found.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function () {
            $('.delete-btn').on('click', function () {
                var postId = $(this).data('id');
                
                // confirmation
                if (confirm('Are you sure you want to delete this post?')) {
                    $.ajax({
                        url: 'deleteaction.php', // Request to delete post
                        type: 'POST',
                        data: { id: postId },
                        success: function (response) {
                            //  takeplace delete
                            var data = JSON.parse(response);
                            if (data.success) {
                                $('#post-' + postId).remove(); // Remove post
                                $('#message').html('<div class="alert alert-success">' + data.success + '</div>');
                            } else {
                                $('#message').html('<div class="alert alert-danger">' + data.error + '</div>');
                            }
                        },
                        error: function () {
                            $('#message').html('<div class="alert alert-danger">An error occurred while processing your request.</div>');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
