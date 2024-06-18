<?php
include 'config.php';

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    echo json_encode(['exists' => $stmt->num_rows > 0]);
    $stmt->close();
}
$conn->close();
?>
