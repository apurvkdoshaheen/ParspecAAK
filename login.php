<?php

// If the form was submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database credentials
    $servername = "parspecdbinstance.ctqg2k80efrn.ap-south-1.rds.amazonaws.com";
    $username = "admin";
    $password = "Crypto2206";
    $dbname = "login";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    //data from username field
    $submitted_username = $_POST['username'];
    $submitted_password = $_POST['password'];
	
	//embed variable in query
	$sql = "SELECT id FROM users WHERE username = '$submitted_username' AND password = '$submitted_password'";
	
	//execute query
	$result = $conn->query($sql);

    // Check if a user was found
    if ($result->num_rows > 0) {
        $message = "Login Successful!";
        $color = "#22c55e"; // Green color for success
    } else {
        $message = "Login Failed. Please try again.";
        $color = "#ef4444"; // Red color for failure
    }

    // Close the connection
    $conn->close();

} else {
    // If the page is accessed directly without a form submission
    $message = "Invalid access.";
    $color = "#9ca3af"; // Gray color for invalid access
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Result</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .result-container {
            background-color: #ffffff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .message {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <p class="message" style="color: <?php echo $color; ?>;"><?php echo htmlspecialchars($message); ?></p>
        <a href="login.html" style="color: #3b82f6; text-decoration: none; font-weight: 500;">Go Back</a>
    </div>
</body>
</html>
