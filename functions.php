<?php
session_start(); // Start the session at the beginning

// Open MySQL database connection
function openCon() {
    $conn = mysqli_connect("localhost", "root", "", "dct-ccs-finals");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

// Close MySQL database connection
function closeCon($conn) {
    return mysqli_close($conn);  // Pass $conn to close the connection
}

function loginUser($username, $password) {
    // Open database connection
    $conn = openCon();

    // Hash the password using md5
    $hashedPassword = md5($password);

    // Prepare the SQL query - make sure the table name is correct (users instead of user)
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword); // Bind the email and hashed password

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user is found
    if ($result->num_rows > 0) {
        // Fetch the user data (optional, if you want to store more info in session)
        $user = $result->fetch_assoc();

        // Store user session data
        $_SESSION['email'] = $username;
        $_SESSION['user_id'] = $user['id']; // Store user ID (if you have an 'id' column in your table)
        return true; // Login successful
    } else {
        // Invalid login credentials
        return false;
    }

    // Close the statement and connection
    $stmt->close();
    closeCon($conn);  // Pass $conn to close the connection
}
?>