<?php
session_start();

function openCon() {
    $conn = new mysqli("localhost", "root", "", "dct-ccs-finals");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeCon($conn) {
    $conn->close();
}

function debugLog($message) {
    error_log("[DEBUG] " . $message);
}

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

function guard() {
    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
}

function isLoggedIn() {
    return isset($_SESSION['email']);
}

function addSubject($subject_code, $subject_name) {
    $conn = openCon();

    $sql = "INSERT INTO subjects (subject_code, subject_name) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error preparing SQL statement: " . $conn->error);
        return false;
    }

    $stmt->bind_param("ss", $subject_code, $subject_name);

    if ($stmt->execute()) {
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        error_log("Error executing SQL query: " . $stmt->error);
        $stmt->close();
        closeCon($conn);
        return false;
    }
}

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

function deleteSubject($subject_id) {
    $conn = openCon();

    $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $subject_id);

    if ($stmt->execute()) {
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        $stmt->close();
        closeCon($conn);
        return false;
    }
}

function countSubjects() {
    $conn = openCon();
    $sql = "SELECT COUNT(*) AS subject_count FROM subjects";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        closeCon($conn);
        return (int)$row['subject_count'];
    } else {
        error_log("Error counting subjects: " . $conn->error);
        closeCon($conn);
        return 0;
    }
}

function registerStudent($studentId, $firstName, $lastName) {
    $conn = openCon();
    $sql = "INSERT INTO students (student_id, first_name, last_name) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error preparing SQL statement: " . $conn->error);
        closeCon($conn);
        return false;
    }

    $stmt->bind_param("sss", $studentId, $firstName, $lastName);

    if ($stmt->execute()) {
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        error_log("Error executing SQL query: " . $stmt->error);
        $stmt->close();
        closeCon($conn);
        return false;
    }
}

function getStudents() {
    $conn = openCon();
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    if ($result) {
        $students = $result->fetch_all(MYSQLI_ASSOC);
        closeCon($conn);
        return $students;
    } else {
        error_log("Error fetching students: " . $conn->error);
        closeCon($conn);
        return [];
    }
}

function getStudentById($id) {
    $conn = openCon();

    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    if (!$stmt) {
        error_log("Error preparing SQL statement: " . $conn->error);
        return null;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $stmt->close();
        closeCon($conn);
        return $student;
    }

    $stmt->close();
    closeCon($conn);
    return null;
}

function updateStudent($id, $studentId, $firstName, $lastName) {
    $conn = openCon();

    $sql = "UPDATE students SET student_id = ?, first_name = ?, last_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error preparing SQL statement: " . $conn->error);
        closeCon($conn);
        return false;
    }

    $stmt->bind_param("sssi", $studentId, $firstName, $lastName, $id);

    if ($stmt->execute()) {
        $stmt->close();
        closeCon($conn);
        return true;
    } else {
        error_log("Error executing SQL query: " . $stmt->error);
        $stmt->close();
        closeCon($conn);
        return false;
    }
}

function deleteStudent($id) {
    $conn = openCon();

    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    if (!$stmt) {
        error_log("Error preparing SQL statement: " . $conn->error);
        closeCon($conn);
        return false;
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $affectedRows = $stmt->affected_rows;
        $stmt->close();
        closeCon($conn);
        return $affectedRows > 0;
    } else {
        error_log("Error executing SQL query: " . $stmt->error);
        $stmt->close();
        closeCon($conn);
        return false;
    }
}
function countStudents() {
    $conn = openCon();
    $sql = "SELECT COUNT(*) AS total FROM students";
    $result = $conn->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        closeCon($conn);
        return (int)$row['total'];
    } else {
        error_log("Error counting students: " . $conn->error);  // Log error if query fails
        closeCon($conn);
        return 0;
    }
}

?>
