<?php
include 'config.php';

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];

    $queryResult = $conn->prepare("SELECT rating, feedback, recycling_points, submission_date FROM user_submissions WHERE username = ? ORDER BY submission_date DESC");
    $queryResult->bind_param("s", $username);
    $queryResult->execute();
    $queryResult->bind_result($rating, $feedback, $recycling_points, $submission_date);

    $journalContent = "";
    while ($queryResult->fetch()) {
        $journalContent .= "Date: " . $submission_date . "\n";
        $journalContent .= "Rating: " . $rating . "/10\n";
        $journalContent .= "Feedback: " . $feedback . "\n";
        $journalContent .= "Visited Recycling Points: " . $recycling_points . "\n";
        $journalContent .= "-------------------------\n";
    }
    $queryResult->close();

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="sustainability_journal.txt"');
    echo $journalContent;
    exit();
} else {
    header("Location: login.php");
    exit();
}
?>
