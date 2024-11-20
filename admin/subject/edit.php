<?php
include('../../functions.php');

// Ensure the user is logged in
guard();

// Check if the subject ID is provided in the query string
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid subject ID.");
}

$id = $_GET['id'];
$conn = openCon();

// Fetch the existing subject details
$sql = "SELECT * FROM subjects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$subject = $result->fetch_assoc();
$stmt->close();
closeCon($conn);

if (!$subject) {
    die("Subject not found.");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $subject_name = $_POST['subject_name'] ?? null;

    // Validate input
    if (empty($subject_name)) {
        echo "<p style='color: red;'>Subject name cannot be empty.</p>";
    } else {
        // Update the subject name
        if (updateSubject($id, $subject['subject_code'], $subject_name)) {
            // Redirect to subject.php after a successful update
            header("Location: add.php");
            exit();
        } else {
            echo "<p style='color: red;'>Error updating subject.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Subject</title>
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
            margin-left: 150px;
        }

        .breadcrumbs {
            margin: 10px 0;
            width: 40%;
            margin-left: 150px;
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
    </style>
</head>
<body>
    <?php include('../partials/header.php'); ?>
    <?php include('../partials/side-bar.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
        <h2>Edit Subject</h2>
        
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="add.php">Subjects</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Subject</li>
            </ol>
        </nav>

        <!-- Edit Subject Form -->
        <div class="container">
            <form action="edit.php?id=<?php echo $id; ?>" method="POST">
                <div class="form-group">
                    <label for="subjectCode">Subject Code</label>
                    <!-- Make the Subject Code read-only -->
                    <input type="text" id="subjectCode" name="subject_code" 
                           value="<?php echo htmlspecialchars($subject['subject_code']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="subjectName">Subject Name</label>
                    <input type="text" id="subjectName" name="subject_name" 
                           value="<?php echo htmlspecialchars($subject['subject_name']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Subject</button>
            </form>
        </div>
    </main>

    <?php include('../partials/footer.php'); ?>
</body>
</html>



