<?php
$servername = "sql113.infinityfree.com";
$username = "if0_40148312";
$password = "Register890";
$database = "if0_40148312_Mydatabase";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts with author details
$sql = "SELECT p.id, p.title, p.created_at, b.name AS author_name 
        FROM posts p
        LEFT JOIN blogcontent b ON p.author_id = b.id
        ORDER BY p.created_at DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Dynamic Blog</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #e6f0ff, #ffffff);
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #0078d7;
            color: white;
            text-align: center;
            padding: 25px 0;
            font-size: 24px;
            font-weight: 600;
            box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        }
        .container {
            max-width: 850px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        .post {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
            transition: 0.3s;
        }
        .post:hover {
            background: #f8faff;
            transform: translateY(-2px);
        }
        .post a {
            text-decoration: none;
            color: #0078d7;
            font-size: 20px;
            font-weight: 600;
            transition: 0.3s;
        }
        .post a:hover {
            color: #005fa3;
        }
        .meta {
            color: #555;
            font-size: 14px;
            margin-top: 5px;
        }
        footer {
            text-align: center;
            padding: 15px;
            color: #666;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<header>
    📰 My Dynamic Blog
</header>

<div class="container">
    <h2>Latest Posts</h2>
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="post">';
            echo '<a href="post.php?id=' . $row['id'] . '">' . htmlspecialchars($row['title']) . '</a>';
            echo '<div class="meta">By ' . htmlspecialchars($row['author_name']) . ' • ' . date('F j, Y', strtotime($row['created_at'])) . '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No posts available yet.</p>";
    }
    $conn->close();
    ?>
</div>

<footer>© 2025 My Dynamic Blog. All rights reserved.</footer>

</body>
</html>
