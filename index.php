
<?php
$posts = json_decode(file_get_contents('posts.json'), true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mini Blog CMS</title>
</head>
<body>
    <h1>My Custom Blog</h1>
    <a href="admin.php">Admin Panel</a>
    <hr>
    <?php if ($posts): ?>
        <?php foreach ($posts as $index => $post): ?>
            <h2><?= htmlspecialchars($post['title']) ?></h2>
            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
            <a href="admin.php?delete=<?= $index ?>">Delete</a>
            <hr>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No posts yet!</p>
    <?php endif; ?>
</body>
</html>
