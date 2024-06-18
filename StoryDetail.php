<?php
// Veritabanı bağlantısı
include 'config.php';

// Hikaye kimliğini al
if (isset($_GET['story_id'])) {
    $story_id = $_GET['story_id'];

    // Veritabanından hikayeyi al
    $queryResult = $conn->prepare("SELECT username, story_title, story_content FROM users_stories WHERE id = ?");
    $queryResult->bind_param("i", $story_id);
    $queryResult->execute();
    $queryResult->bind_result($usernameStr, $story_title, $story_content);
    $queryResult->fetch();
    $queryResult->close();

    // Hikaye yorumlarını al
    $commentQuery = $conn->prepare("SELECT id, username, comment, comment_date FROM comments WHERE story_id = ?");
    $commentQuery->bind_param("i", $story_id);
    $commentQuery->execute();
    $commentQuery->bind_result($comment_id, $comment_username, $comment_text, $comment_date);
    $comments = array();
    while ($commentQuery->fetch()) {
        $comments[] = array(
            'id' => $comment_id,
            'username' => $comment_username,
            'comment' => $comment_text,
            'date' => $comment_date
        );
    }
    $commentQuery->close();
} else {
    header("Location: LoginPage.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment']) && isset($_COOKIE['username'])) {
    $comment = $_POST['comment'];
    $username = $_COOKIE['username'];

    $insertComment = $conn->prepare("INSERT INTO comments (story_id, username, comment, comment_date) VALUES (?, ?, ?, NOW())");
    $insertComment->bind_param("iss", $story_id, $username, $comment);
    $insertComment->execute();
    $insertComment->close();

    // Sayfayı yeniden yükleyerek yeni yorumları göstermek için yeniden yönlendir
    header("Location: StoryDetail.php?story_id=" . $story_id);
    exit();
}

// Yorum silme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_comment_id']) && isset($_COOKIE['username'])) {
    $delete_comment_id = $_POST['delete_comment_id'];
    $username = $_COOKIE['username'];

    // Yalnızca yorumun sahibi olan kullanıcı yorumunu silebilir
    $deleteComment = $conn->prepare("DELETE FROM comments WHERE id = ? AND username = ?");
    $deleteComment->bind_param("is", $delete_comment_id, $username);
    $deleteComment->execute();
    $deleteComment->close();

    // Sayfayı yeniden yükleyerek güncellenmiş yorumları göstermek için yeniden yönlendir
    header("Location: StoryDetail.php?story_id=" . $story_id);
    exit();
}

// Hikaye silme işlemi
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_story']) && isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];

    // Yalnızca hikayenin sahibi olan kullanıcı hikayeyi silebilir
    $deleteStory = $conn->prepare("DELETE FROM users_stories WHERE id = ? AND username = ?");
    $deleteStory->bind_param("is", $story_id, $username);
    $deleteStory->execute();
    $deleteStory->close();

    // Sayfayı yeniden yükleyerek hikayeler sayfasına yönlendir
    header("Location: LoggedIn.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($story_title); ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9f7ef;
            color: #2c3e50;
        }
        .story-card {
            margin-top: 20px;
            background-color: #ecf0f1;
            border: 1px solid #bdc3c7;
        }
        .story-card .card-header {
            background-color: #1abc9c;
            color: white;
        }
        .story-card .card-body {
            background-color: #f5f5f5;
        }
        .comment {
            background-color: #dff9fb;
            border: 1px solid #badc58;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="card story-card">
        <div class="card-header">
            <h2 class="card-title"><?php echo htmlspecialchars($story_title); ?></h2>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo nl2br(htmlspecialchars($story_content)); ?></p>
            <h6 class="card-title text-right"><?php echo htmlspecialchars($usernameStr); ?></h6>
            <hr>
            <h4>Comments</h4>
            <?php if (!empty($comments)): ?>
                <div class="comments">
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment mb-3 p-3 border rounded">
                            <strong><?php echo htmlspecialchars($comment['username']); ?></strong>
                            <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                            <span class="text-muted"><?php echo htmlspecialchars($comment['date']); ?></span>
                            <?php if (isset($_COOKIE['username']) && $_COOKIE['username'] == $comment['username']): ?>
                                <form action="StoryDetail.php?story_id=<?php echo $story_id; ?>" method="post" style="display:inline;">
                                    <input type="hidden" name="delete_comment_id" value="<?php echo $comment['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm ml-2">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No comments yet.</p>
            <?php endif; ?>
            <hr>
            <?php if (isset($_COOKIE['username'])): ?>
                <form action="StoryDetail.php?story_id=<?php echo $story_id; ?>" method="post">
                    <div class="form-group">
                        <label for="comment">Add a Comment:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php else: ?>
                <p>Please <a
                href="login.php">log in</a> to leave a comment.</p>
<p>If you don't have an account, <a href="RegisterPage.php">create one here</a>.</p>
<?php endif; ?>
<hr>
 <!-- Hikaye silme işlemi -->
 <div class="d-flex justify-content-between align-items-center">
                <?php if (isset($_COOKIE['username']) && $_COOKIE['username'] == $usernameStr): ?>
                    <a href="<?php echo isset($_COOKIE['username']) ? 'LoggedIn.php' : 'Main.php'; ?>" class="btn btn-primary">Back to Stories</a>
                    <form action="StoryDetail.php?story_id=<?php echo $story_id; ?>" method="post">
                        <input type="hidden" name="delete_story">
                        <button type="submit" class="btn btn-danger">Delete Story</button>
                    </form>
                <?php endif; ?>
              
            </div>
        </div>
    </div>
</div>
</body>
</html>
