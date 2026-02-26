<?php
// Fetch the existing blog content from the JSON file
$filePath = 'json/blog_content.json';

// Check if the file exists and is readable
if (file_exists($filePath) && filesize($filePath) > 0) {
    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);
} else {
    $data = [];
}

// Fetch the blog entry to display
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $blog = null;

    foreach ($data as $entry) {
        if ($entry['id'] == $id) {
            $blog = $entry;
            break;
        }
    }

    if ($blog === null) {
        echo "<p>Blog not found.</p>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog - <?= $blog['name']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        /* Navigation bar style */
        nav {
            background-color: #333;
            padding: 10px 20px;
        }
        nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 1.1rem;
            margin-right: 10px;
        }
        nav a:hover {
            background-color: #575757;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .blog-content {
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .back-btn {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 1rem;
            display: block;
            width: 100px;
            margin: 20px auto;
            text-align: center;
        }
        .back-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav>
        <a href="all_blogs.php">All Blogs</a>
        <a href="upload_blog.php">Upload Blog</a>
    </nav>

    <div class="container">
        <h1><?= $blog['name']; ?></h1>

        <div class="blog-content">
            <h3>Category: <?= $blog['category']; ?></h3>
            <div><?= $blog['content']; ?></div>
        </div>

        <a href="all_blogs.php" class="back-btn">Back to Blogs</a>
    </div>

</body>
</html>
