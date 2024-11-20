<?php
session_start();

/**
 * Opens a new database connection
 */
function openCon() {
    $conn = new mysqli("localhost", "root", "", "dct-ccs-finals");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

/**
 * Closes the database connection
 */
function closeCon($conn) {
    $conn->close();
}

/**
 * Custom debug logging function.
 */
function debugLog($message) {
    error_log("[DEBUG] " . $message);
}

/**
 * Logs in the user by checking username and password
 */
function loginUser($username, $password) {
    $conn = openCon();

    $hashedPassword = md5($password);
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashedPassword);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['email'] = $username;
        $_SESSION['user_id'] = $user['id'];
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        $stmt->close();
        closeCon($conn);
        return false;
    }
}

/**
 * Redirects unauthenticated users to the login page
 */
function guard() {
    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
}

/**
 * Checks if a user is logged in
 */
function isLoggedIn() {
    return isset($_SESSION['email']);
}

/**
 * Adds a new subject to the subjects table
 */
function addSubject($subject_code, $subject_name) {
    $conn = openCon();

    // Log data being inserted for debugging
    error_log("Adding Subject: Subject Code - $subject_code, Subject Name - $subject_name");

    // Prepare the SQL query
    $sql = "INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error preparing SQL statement: " . $conn->error);
        return false;
    }

    // Bind the parameters
    $stmt->bind_param("ss", $subject_code, $subject_name);

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        // Log SQL execution errors
        error_log("Error executing SQL query: " . $stmt->error);
        $stmt->close();
        closeCon($conn);
        return false;
    }
}

/**
 * Updates an existing subject in the subjects table
 */
function updateSubject($id, $subject_code, $subject_name) {
    if (empty($subject_code) || empty($subject_name) || empty($id)) {
        debugLog("Invalid input provided to updateSubject.");
        return false;
    }

    $conn = openCon();
    $sql = "UPDATE subjects SET subject_code = ?, subject_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        debugLog("Error preparing statement: " . $conn->error);
        return false;
    }

    $stmt->bind_param("ssi", $subject_code, $subject_name, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            $stmt->close();
            closeCon($conn);
            return true;
        } else {
            debugLog("No rows were updated for ID: $id");
        }
    } else {
        debugLog("Error executing query: " . $stmt->error);
    }

    $stmt->close();
    closeCon($conn);
    return false;
}

/**
 * Deletes a subject from the subjects table
 */
function deleteSubject($subject_id) {
    $conn = openCon();  // Open database connection

    // Prepare SQL query to delete the subject by ID
    $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $subject_id);

    if ($stmt->execute()) {
        $stmt->close();
        closeCon($conn);  // Close the connection
        return true;  // Successfully deleted
    } else {
        $stmt->close();
        closeCon($conn);  // Close the connection
        return false;  // Deletion failed
    }
}


?>
