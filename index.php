<?php
include 'db.php'; // Connect to the database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Blog</title>
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
                <div id="postsContainer"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script>
        // Function to fetch and display posts via AJAX
        function loadPosts() {
            const postsContainer = document.getElementById('postsContainer');
            
            // Clear existing content
            postsContainer.innerHTML = '<p>Loading posts...</p>';

            // Make AJAX request to fetch posts
            fetch('fetchpost.php') // This will be the PHP file responsible for fetching posts
                .then(response => response.json())
                .then(posts => {
                    // Clear loading message
                    postsContainer.innerHTML = '';

                    // Check if there are any posts
                    if (posts.length > 0) {
                        posts.forEach(post => {
                            const postCard = `
                                <div class="card mb-3" style="max-width: 800px;">
                                    <div class="row g-0">
                                        <div class="col-md-7">
                                            <div class="card-body">
                                                <h5 class="card-title">${post.title}</h5>
                                                <p class="card-text">${post.content}</p>
                                                <p class="card-text"><small class="text-muted">${post.timestamp}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            postsContainer.innerHTML += postCard;
                        });
                    } else {
                        postsContainer.innerHTML = "<p class='text-muted'>No posts found.</p>";
                    }
                })
                .catch(error => {
                    postsContainer.innerHTML = '<p class="text-danger">Error loading posts.</p>';
                });
        }

        // Call loadPosts when the page loads
        window.onload = loadPosts;
    </script>
</body>
</html>
