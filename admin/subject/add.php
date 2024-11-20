<?php
include('../../functions.php'); // Adjusted path to functions.php

// Check if the user is logged in, otherwise redirect
guard();

// Error messages array
$errorMessages = [];

// Handle subject form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subject_code'], $_POST['subject_name'])) {
    $subject_code = $_POST['subject_code'];
    $subject_name = $_POST['subject_name'];

    // Check if subject code is empty
    if (empty($subject_code)) {
        $errorMessages[] = "Subject code cannot be empty.";
    }

    // Check if the subject code already exists in the database
    if (empty($errorMessages)) {
        $conn = openCon();
        $sql = "SELECT * FROM subjects WHERE subject_code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $subject_code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $errorMessages[] = "Subject code already exists.";
        }
        $stmt->close();
        closeCon($conn);
    }

    // If there are no errors, insert the new subject
    if (empty($errorMessages)) {
        if (addSubject($subject_code, $subject_name)) {
            echo "<p>Subject added successfully.</p>";
        } else {
            echo "<p>Error adding subject.</p>";
        }
    }
}

// Fetch all subjects to display in the list
$conn = openCon();
$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);
closeCon($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Subject</title>
    <link rel="stylesheet" href="path_to_your_css.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .h2 {
            width: 60%;
            margin-left: 170px;
        }

        .breadcrumbs {
            margin: 10px 0;
            width: 40%;
            margin-left: 100px; /* Adjust this value to control how much to the left */
        }

        .breadcrumbs ol {
            background-color: transparent;
            padding: 10px;
            border-radius: 5px;
        }

        .breadcrumbs a {
            color: #007bff;
            text-decoration: none;
        }

        .breadcrumbs .breadcrumb-item.active {
            color: #6c757d;
        }

        .error-box {
            width: 86%;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            margin-left: 105px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-box li {
            margin-bottom: 10px;
        }

        .error-box .error-title {
            font-weight: bold;
            font-size: 18px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 20%;
            padding: 15px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        .student-list-container {
            margin-top: 40px;
            margin-left: 150px;
        }

        .student-list table {
            width: 75%;
            border-collapse: collapse;
        }

        .student-list th, .student-list td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .student-list th {
            background-color: #f8f9fa;
        }

        .student-list td {
            background-color: #fdfdfd;
        }

        .student-list tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons a {
            padding: 5px 10px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
        }

        .action-buttons a:hover {
            background-color: #0056b3;
        }

        .action-buttons .delete {
            background-color: #dc3545;
        }

        .action-buttons .delete:hover {
            background-color: #c82333;
        }

        .btn-custom {
            background-color: #17a2b8;
            border-color: #17a2b8;
            color: white;
        }

        .btn-custom:hover {
            background-color: #138496;
            border-color: #138496;
        }

        .btn.btn-primary {
            width: 100%; 
        }

    
        h2 {
            text-align: left; 
            margin-left: 100px; 
        }
    </style>
</head>
<body>
    <?php include('../partials/header.php'); ?>
    <?php include('../partials/side-bar.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
        <h2>Add a New Subject</h2>

        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Subject</li>
            </ol>
        </nav>

        <!-- Error Box -->
        <?php if (!empty($errorMessages)): ?>
            <div class="error-box">
                <div class="error-title">System Errors:</div> <!-- Title above the errors -->
                <ul>
                    <?php foreach ($errorMessages as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Subject Form -->
        <div class="container">
            <form action="add.php" method="POST">
                <div class="form-group">
                    <input type="text" id="subjectCode" name="subject_code" placeholder="Subject Code" >
                </div>
                <div class="form-group">
                    <input type="text" id="subjectName" name="subject_name" placeholder="Subject Name" >
                </div>
                <button type="submit" class="btn btn-primary">Add Subject</button>
            </form>
        </div>

        <!-- Subject List -->
        <div class="student-list-container container">
            <h3>Subject List</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['subject_code']}</td>
                                    <td>{$row['subject_name']}</td>
                                    <td class='action-buttons'>
                                        <a href='edit.php?id={$row['id']}' class='btn btn-custom'>Edit</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-custom delete'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No subjects found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include('../partials/footer.php'); ?>
</body>
</html>
