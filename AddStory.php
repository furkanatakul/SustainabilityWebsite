<?php
if (isset($_COOKIE['username'])) {
    include 'config.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $storyTitle = $_POST['story_title'];
        $storyContent = $_POST['story_content'];
        $username = $_COOKIE['username'];
        $insertStmt = $conn->prepare("INSERT INTO users_stories (username, story_title, story_content, submission_date) VALUES (?, ?, ?, NOW())");
        $insertStmt->bind_param("sss", $username, $storyTitle, $storyContent);
        $insertStmt->execute();
        $insertStmt->close();
        header("Location: LoggedIn.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Story</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add Story</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="story_title">Story Title:</label>
                <input type="text" class="form-control" id="story_title" name="story_title" required>
            </div>
            <div class="form-group">
                <label for="story_content">Story Content:</label>
                <textarea class="form-control" id="story_content" name="story_content" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Story</button>
        </form>
    </div>
</body>
</html>
<?php
} else {
    header("Location: login.php");
    exit();
}
?>
