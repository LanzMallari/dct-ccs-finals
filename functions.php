<?php
session_start();

function openCon() {
    $conn = mysqli_connect("localhost", "root", "", "dct-ccs-finals");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function closeCon($conn) {
    return mysqli_close($conn);
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
        return true;
    } else {
        return false;
    }

    $stmt->close();
    closeCon($conn);
}



?>
