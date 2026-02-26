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

// Handle delete action
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];
    // Filter the data to remove the entry with the given ID
    $data = array_filter($data, function ($entry) use ($deleteId) {
        return $entry['id'] != $deleteId;
    });

    // Re-index the array and save the updated data back to the file
    $data = array_values($data);
    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

    // Redirect to the same page after deletion
    header("Location: all_blogs.php?status=deleted");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Blogs - Manage Blogs</title>
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
            margin: 20px auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ccc;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            font-size: 1rem;
        }
        .action-btn {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .action-btn:hover {
            background-color: #0056b3;
        }
        .delete-btn {
            background-color: #dc3545;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
        }
        .success {
            color: green;
            background-color: #d4edda;
        }
        .fail {
            color: red;
            background-color: #f8d7da;
        }
        .deleted {
            color: darkorange;
            background-color: #fff3cd;
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
        <h1>Manage Blogs</h1>

        <!-- Show messages based on the query parameter -->
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'success') {
                echo '<div class="message success">Content saved successfully!</div>';
            } elseif ($_GET['status'] == 'fail') {
                echo '<div class="message fail">Failed to save content. Please try again.</div>';
            } elseif ($_GET['status'] == 'deleted') {
                echo '<div class="message deleted">Blog entry deleted successfully!</div>';
            }
        }
        ?>

        <!-- Display blogs -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Content (Preview)</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($data)) {
                    foreach ($data as $blog) {
                        $id = (int)$blog['id'];
                        $name = htmlspecialchars($blog['name'] ?? '');
                        $category = htmlspecialchars($blog['category'] ?? '');
                    
                        $contentPreview = strip_tags($blog['content'] ?? '');
                        $contentPreview = (strlen($contentPreview) > 100) ? substr($contentPreview, 0, 100) . '...' : $contentPreview;
                    
                        echo "<tr>
                                <td>{$id}</td>
                                <td>{$name}</td>
                                <td>{$category}</td>
                                <td>{$contentPreview}</td>
                                <td>
                                    <a href='view_blog.php?id={$id}' class='action-btn'>View</a>
                                    <a href='edit_blog.php?id={$id}' class='action-btn' style='background:#17a2b8;'>Edit</a>
                                    <a href='all_blogs.php?delete_id={$id}' class='action-btn delete-btn'
                                       onclick='return confirm(\"Are you sure you want to delete this blog?\")'>
                                       Delete
                                    </a>
                                </td>
                              </tr>";
                    }

                } else {
                    echo "<tr><td colspan='5' style='text-align: center;'>No blogs available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
