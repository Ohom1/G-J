<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seo_services_digital"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Unable to connect to the database: " . $conn->connect_error);
}

// Check if form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure $_POST variables are set to avoid undefined index notices
    $name = isset($_POST['s_name']) ? trim($_POST['s_name']) : '';
    $mobile = isset($_POST['s_mobile']) ? trim($_POST['s_mobile']) : '';
    $email = isset($_POST['s_email']) ? trim($_POST['s_email']) : '';
    $service = isset($_POST['s_service']) ? trim($_POST['s_service']) : '';

    // Echo every attribute before validation
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Mobile: " . htmlspecialchars($mobile) . "<br>";
    echo "Email: " . htmlspecialchars($email) . "<br>";
    echo "Service: " . htmlspecialchars($service) . "<br><br>";

    // Validate input
    if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) {
        die("A valid 10-digit mobile number is required.");
    }

    if (empty($service)) {
        die("Service selection is required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Prepare SQL query using prepared statements
    $stmt = $conn->prepare("INSERT INTO service_form (name, mobile, email, service) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $name, $mobile, $email, $service);

    // Execute the query
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "There was an error sending your message: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
