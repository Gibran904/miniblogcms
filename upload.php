
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    $fileName = basename($_FILES['media']['name']);
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['media']['tmp_name'], $targetFile)) {
        $message = "Uploaded successfully: <a href='$targetFile'>$fileName</a>";
    } else {
        $message = "Failed to upload file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Media</title>
</head>
<body>
    <h1>Upload Media</h1>
    <a href="admin.php">Back to Admin</a> | <a href="logout.php">Logout</a>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="media" required><br><br>
        <button type="submit">Upload</button>
    </form>
    <?php if (isset($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
</body>
</html>
