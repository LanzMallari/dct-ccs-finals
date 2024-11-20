<?php
include('../../functions.php');
guard(); // Ensure the user is logged in
include('../partials/header.php'); 
include('../partials/side-bar.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        .container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
            max-width: 800px;
            margin: 20px auto;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .breadcrumbs {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .breadcrumbs a {
            color: #6c757d; /* Inactive link color */
            text-decoration: none;
        }
        .breadcrumbs a.active {
            color: #007bff; /* Active link color */
        }
        .breadcrumbs a:hover {
            text-decoration: underline;
        }
        .heading {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .details {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .details ul {
            list-style: none;
            padding: 0;
        }
        .details li {
            margin-bottom: 10px;
        }
        .buttons {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-cancel {
            background: #ccc;
            color: #000;
        }
        .btn-delete {
            background: #dc3545;
            color: #fff;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Page Title -->
        <div class="header">Delete Student</div>

        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <a href="dashboard.php">Dashboard</a> / 
            <a href="students.php">Students</a> / 
            <a href="#" class="active">Delete Student</a>
        </div>

        <!-- Confirmation Message -->
        <div class="heading">Are you sure you want to delete the following student record?</div>
        <div class="details">
            <ul>
                <li><strong>Student ID:</strong> 1001</li>
                <li><strong>Student Name:</strong> John Doe</li>
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="buttons">
            <button class="btn btn-cancel" onclick="window.location.href='students.php'">Cancel</button>
            <form method="post" action="delete_student.php" style="display: inline;">
                <input type="hidden" name="student_id" value="1001">
                <button type="submit" class="btn btn-delete">Delete Student Record</button>
            </form>
        </div>
    </div>

    <?php include('../partials/footer.php'); ?>
</body>
</html>
