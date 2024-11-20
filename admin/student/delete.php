<?php
// Include necessary files
include('../../functions.php'); 


// Guard to prevent unauthorized access
guard();

// Get the student ID from the query string
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    echo "<script>alert('No student ID provided!'); window.location.href = 'add.php';</script>";
    exit();
}

// Fetch student details
$conn = openCon();
$stmt = $conn->prepare("SELECT student_id, first_name, last_name FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

if (!$student) {
    echo "<script>alert('Student not found!'); window.location.href = 'add.php';</script>";
    exit();
}

$stmt->close();
closeCon($conn);

// Handle deletion request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = openCon();
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: /admin/student/register.php");
        exit();
    } else {
        echo "<script>alert('Failed to delete student record.');</script>";
    }
    

    $stmt->close();
    closeCon($conn);
    exit();
}
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
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        .breadcrumbs {
            margin: 10px 0;
            width: 40%;
            margin-left: 100px;
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

        .details {
            margin-top: 20px;
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
            justify-content: flex-start;
            gap: 10px;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        /* Cancel Button Styles */
        .btn-cancel {
            background: #808080 !important; /* Grey */
            color: #fff !important;
        }

        .btn-delete {
            background: #007bff !important; /* Blue */
            color: #fff !important;
        }

        .btn:hover {
            opacity: 0.9 !important;
        }

        .btn-cancel:hover {
            background: #6c6c6c !important; 
        }

        .btn-delete:hover {
            background: #0056b3 !important; 
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


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
        <h2>Delete Student</h2>
        
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="register.php">Students</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete Student</li>
            </ol>
        </nav>

        <!-- Delete Student Confirmation -->
        <div class="container">
            <p>Are you sure you want to delete the following student record?</p>
            <div class="details">
                <ul>
                    <li><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></li>
                    <li><strong>First Name:</strong> <?php echo htmlspecialchars($student['first_name']); ?></li>
                    <li><strong>Last Name:</strong> <?php echo htmlspecialchars($student['last_name']); ?></li>
                </ul>
            </div>
            <div class="buttons">
                <button class="btn btn-cancel" onclick="window.location.href='add.php'">Cancel</button>
                <form method="post" action="">
                    <button type="submit" class="btn btn-delete">Delete Student Record</button>
                </form>
            </div>
        </div>
    </main>

    <?php include('../partials/footer.php'); ?>
</body>
</html>
