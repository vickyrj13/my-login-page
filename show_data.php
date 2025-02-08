<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show User Data</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white min-h-screen p-8 flex flex-col items-center">
  <h2 class="text-3xl font-bold mb-8 text-center text-yellow-400">User Data from Database</h2>

  <div class="overflow-x-auto w-full max-w-4xl shadow-lg rounded-lg bg-gray-800">
    <table class="w-full table-auto border-collapse border border-gray-700 text-left">
      <thead class="bg-gray-700 text-yellow-300">
        <tr>
          <th class="border border-gray-600 px-4 py-3">ID</th>
          <th class="border border-gray-600 px-4 py-3">Username</th>
          <th class="border border-gray-600 px-4 py-3">Nickname</th>
          <th class="border border-gray-600 px-4 py-3">Email</th>
          <th class="border border-gray-600 px-4 py-3">Actions</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-700">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vikram";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, username, nickname, email FROM saxena";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='hover:bg-gray-700'>
                        <td class='border border-gray-600 px-4 py-3'>{$row['id']}</td>
                        <td class='border border-gray-600 px-4 py-3'>{$row['username']}</td>
                        <td class='border border-gray-600 px-4 py-3'>{$row['nickname']}</td>
                        <td class='border border-gray-600 px-4 py-3'>{$row['email']}</td>
                        <td class='border border-gray-600 px-4 py-3'>
                          <form action='delete.php' method='POST' class='inline-block' onsubmit='return confirm(\"Are you sure you want to delete this record?\");'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 transition-transform transform hover:scale-105'>
                              Delete
                            </button>
                          </form>
                          <a href='edit.php?id={$row['id']}' class='ml-4 bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 transform transition-transform hover:scale-105'>
                            Edit
                          </a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='text-center py-4'>No data found</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>

  <a href="./index.html" class="mt-8 bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 transform transition-all duration-300 hover:scale-105">
    Back to Form
  </a>

</body>
</html>
