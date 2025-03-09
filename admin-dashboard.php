<?php
// Start the session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin-login.html");
    exit();
}

// Database connection details
$servername = "localhost";
$username = "admin"; // Make sure this username is correct
$password = "admin"; // Make sure this password is correct
$dbname = "inquiry_db"; // Database name

// Create the MySQL connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve customer inquiries from the "inquiry" table
$sql = "SELECT * FROM inquiry";
$result = $conn->query($sql);

// Check if the query was successful
if (!$result) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Customer Inquiries</h2>

<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Check if there are any rows
        if ($result->num_rows > 0) {
            // Loop through the inquiries and display them
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['name']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['phone']) . "</td>
                        <td>" . htmlspecialchars($row['address']) . "</td>
                        <td>" . htmlspecialchars($row['message']) . "</td>
                      </tr>";
            }
        } else {
            // If no rows found, show a message
            echo "<tr><td colspan='5'>No inquiries found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
