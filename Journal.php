<?php
include 'config.php';
if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $queryResult = $conn->prepare("SELECT rating, feedback, recycling_points, submission_date FROM user_submissions WHERE username = ? ORDER BY submission_date DESC");
    $queryResult->bind_param("s", $username);
    $queryResult->execute();
    $queryResult->bind_result($rating, $feedback, $recycling_points, $submission_date);
    $journals = array();
    while ($queryResult->fetch()) {
        $journals[] = array(
            'rating' => $rating,
            'feedback' => $feedback,
            'recycling_points' => $recycling_points,
            'submission_date' => $submission_date
        );
    }
    $queryResult->close();
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Journal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9f7ef;
            color: #2c3e50;
        }
        .journal-card {
            margin-bottom: 20px;
        }
        .journal-card .card-header {
            background-color: #1abc9c;
            color: white;
        }
        .journal-card .card-body {
            background-color: #ecf0f1;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-5">Your Sustainability Journal</h1>
    <div class="row">
    <div class="col text-left">
        <a href="<?php echo isset($_COOKIE['username']) ? 'LoggedIn.php' : 'Main.php'; ?>" class="btn btn-primary">Back to Main Page</a>
    </div>
    <div class="col text-right mb-3">
        <form action="download_journal.php" method="post">
            <button type="submit" class="btn btn-success">Download Your Journal</button>
        </form>
    </div>
</div>
    <?php if (!empty($journals)): ?>
        <?php foreach ($journals as $journal): ?>
            <div class="card journal-card">
                <div class="card-header">
                    <h3><?php echo htmlspecialchars($journal['submission_date']); ?></h3>
                </div>
                <div class="card-body">
                    <h5>Rating: <?php echo htmlspecialchars($journal['rating']); ?>/10</h5>
                    <p><strong>Feedback:</strong> <?php echo nl2br(htmlspecialchars($journal['feedback'])); ?></p>
                    <p><strong>Visited Recycling Points:</strong> <?php echo htmlspecialchars($journal['recycling_points']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="text-center">You have not added any journal entries yet. Start by sharing your thoughts and sustainability efforts!</p>
    <?php endif; ?>
</div>
</body>
</html>

