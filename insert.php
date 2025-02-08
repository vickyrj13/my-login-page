<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vikram";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the database
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];

    $sql = "INSERT INTO saxena (username, nickname, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $nickname, $email);

    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

// Redirect back to the form after insertion
header("Location: index.html");
exit;
?>
