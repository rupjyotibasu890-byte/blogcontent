<?php
$servername = "sql113.infinityfree.com";
$username = "if0_40148312";
$password = "Register890";
$database = "if0_40148312_Mydatabase";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = $_GET['id'] ?? 0;
$sql = "SELECT p.title, p.content, p.created_at, b.name AS author_name 
        FROM posts p
        LEFT JOIN blogcontent b ON p.author_id = b.id
        WHERE p.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title'] ?? "Post Not Found") ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #f0f7ff, #ffffff);
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
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .meta {
            color: #777;
            font-size: 14px;
            margin-bottom: 20px;
        }
        p {
            color: #444;
            line-height: 1.8;
        }
        a.back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #0078d7;
            font-weight: 600;
        }
        a.back:hover {
            color: #005fa3;
        }
    </style>
</head>
<body>
<header>📰 My Dynamic Blog</header>

<div class="container">
    <?php if ($post): ?>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="meta">By <?= htmlspecialchars($post['author_name']) ?> • <?= date('F j, Y', strtotime($post['created_at'])) ?></div>
        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        <a href="index.php" class="back">← Back to Home</a>
    <?php else: ?>
        <p>Post not found.</p>
        <a href="index.php" class="back">← Back to Home</a>
    <?php endif; ?>
</div>

</body>
</html>
