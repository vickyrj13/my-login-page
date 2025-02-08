<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vikram";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$id) {
    echo "Invalid or missing user ID!";
    exit;
}

$userData = [];

$sql = "SELECT * FROM saxena WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    echo "Record not found!";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $nickname = isset($_POST['nickname']) ? trim($_POST['nickname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($username && $nickname && $email) {
        $updateStmt = $conn->prepare("UPDATE saxena SET username = ?, nickname = ?, email = ? WHERE id = ?");
        $updateStmt->bind_param("sssi", $username, $nickname, $email, $id);

        if ($updateStmt->execute()) {
            header("Location: show_data.php");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        echo "All fields are required!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-900 text-amber-50 flex items-center justify-center min-h-screen">
  <div class="bg-neutral-950 p-8 rounded-lg w-full max-w-lg shadow-lg">
    <h2 class="text-2xl font-bold text-center mb-6 text-yellow-400">Edit User Data</h2>

    <form method="POST" class="bg-neutral-800 p-6 rounded-lg shadow-md">
      <div class="mb-4">
        <label class="block text-white mb-1 font-medium">Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($userData['username'] ?? '') ?>" required class="w-full p-3 bg-neutral-700 rounded-md text-white shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-transform transform hover:scale-105">
      </div>
      <div class="mb-4">
        <label class="block text-white mb-1 font-medium">Nickname</label>
        <input type="text" name="nickname" value="<?= htmlspecialchars($userData['nickname'] ?? '') ?>" required class="w-full p-3 bg-neutral-700 rounded-md text-white shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-transform transform hover:scale-105">
      </div>
      <div class="mb-4">
        <label class="block text-white mb-1 font-medium">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($userData['email'] ?? '') ?>" required class="w-full p-3 bg-neutral-700 rounded-md text-white shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-400 transition-transform transform hover:scale-105">
      </div>
      <button type="submit" class="w-full p-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-transform transform hover:scale-105">
        Update
      </button>
    </form>

    <a href="show_data.php" class="block mt-4 w-full text-center p-3 bg-yellow-500 text-black font-semibold rounded-md hover:bg-yellow-600 transition-transform transform hover:scale-105">
      Back to User List
    </a>
  </div>
</body>
</html>
