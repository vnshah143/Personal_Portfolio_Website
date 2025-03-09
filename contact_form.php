<?php
// Database connection
$servername = "localhost";  // Change this if you're using a different server
$username = "root";        // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "inquiry_db";     // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize message variable
$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and sanitize it
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $address = $conn->real_escape_string(trim($_POST['address']));
    $messageContent = $conn->real_escape_string(trim($_POST['message']));

    // Prepare the SQL query using a prepared statement
    $stmt = $conn->prepare("INSERT INTO inquiry (name, email, phone, address, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $address, $messageContent); // Bind the parameters

    // Execute the query
    if ($stmt->execute()) {
        $message = "Your inquiry has been submitted successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | Contact</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
    <!-- Link to Font Awesome for social media icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="contact">
        <div class="heading">
            <h1>Please fill the below form for inquiry</h1>
        </div>

        <form id="Inquiry" class="Inquiry" action="contact_form.php" method="POST">
            <!-- Display Success or Error Message Inside the Form -->
            <?php if (!empty($message)): ?>
                <p class="<?php echo strpos($message, 'Error') === false ? 'message' : 'error'; ?>">
                    <?php echo $message; ?>
                </p>
            <?php endif; ?>

            <div class="inputBox">
                <input type="text" placeholder="Your name" name="name" required>
                <input type="email" placeholder="Your email" name="email" required>
            </div>
            <div class="inputBox">
                <input type="number" placeholder="Your phone number" name="phone" required>
                <input type="text" placeholder="Your address" name="address" required>
            </div>
            <textarea placeholder="Write your message here" name="message" cols="20" rows="10" required></textarea>
            <input type="submit" value="Send Your Inquiry" class="btn2">
        </form>
    </section>

    <section class="social-icons">
        <a href="https://www.linkedin.com/in/vishal-shah-17a411101/" target="_blank" class="fab fa-linkedin"></a>
        <a href="https://twitter.com" target="_blank" class="fab fa-twitter"></a>
        <a href="https://www.facebook.com" target="_blank" class="fab fa-facebook-f"></a>
        <a href="https://github.com/vnshah143?tab=projects" target="_blank" class="fab fa-github"></a>
    </section>
</body>
</html>
