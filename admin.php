
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$postsFile = 'posts.json';
$posts = file_exists($postsFile) ? json_decode(file_get_contents($postsFile), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $posts[] = [
        'title' => $_POST['title'],
        'content' => $_POST['content']
    ];
    file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT));
    header('Location: admin.php');
    exit;
}

if (isset($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    if (isset($posts[$index])) {
        array_splice($posts, $index, 1);
        file_put_contents($postsFile, json_encode($posts, JSON_PRETTY_PRINT));
    }
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <a href="index.php">Back to Blog</a> | <a href="logout.php">Logout</a>
    <h2>Add New Post</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required><br><br>
        <textarea name="content" placeholder="Content" required></textarea><br><br>
        <button type="submit">Add Post</button>
    </form>

    <h2>Existing Posts</h2>
    <ul>
        <?php foreach ($posts as $index => $post): ?>
            <li><?= htmlspecialchars($post['title']) ?> - <a href="admin.php?delete=<?= $index ?>">Delete</a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
