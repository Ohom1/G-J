<?php
// include("dp.php");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "seo_services_digital"; 

$conn = new mysqli($servername, $username, $password, $dbname);



if (!$conn) {
    echo "Unable to connect to the database.";
    exit();
}else{

// Check if form is submitted using POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Prepare SQL query using prepared statements
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing the query.");
    }

    // Bind parameters
    $stmt->bind_param("sss", $name, $email, $message);

    // Execute the query
    if ($stmt->execute()) {
        echo "Message sent successfully!";
    } else {
        echo "There was an error sending your message.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
}

?>
