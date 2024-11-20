<?php
// Include necessary files
include('../../functions.php');  // Include the functions file
include('../partials/header.php');
include('../partials/side-bar.php');

$title = "Edit Student"; // Set the title variable

// Get the student details to edit
$studentId = $_GET['id'] ?? null; // Check if 'id' is set in the query string
if (!$studentId) {
    echo "<p class='alert alert-danger'>Invalid student ID.</p>";
    exit;
}

$student = getStudentById($studentId); // Function to fetch student details by ID
if (!$student) {
    echo "<p class='alert alert-danger'>Student not found.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $updatedStudentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Update the student details
    if (updateStudent($studentId, $updatedStudentId, $firstName, $lastName)) {
        header('Location: add.php'); // Redirect after updating
        exit;
    } else {
        echo "<p class='alert alert-danger'>Failed to update student.</p>";
    }
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
    <h1 class="h2"><?php echo $title; ?></h1>

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 50%;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-size: 14px;
        color: #555;
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .breadcrumbs {
        margin-bottom: 20px;
    }

    .breadcrumbs ol {
        padding: 0;
        list-style: none;
        display: flex;
        gap: 5px;
    }

    .breadcrumbs ol li {
        font-size: 14px;
    }

    .breadcrumbs ol li a {
        text-decoration: none;
        color: #007bff;
    }

    .breadcrumbs ol li.active {
        color: #6c757d;
    }
    </style>

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol>
            <li><a href="dashboard.php">Dashboard</a> /</li>
            <li><a href="register_student.php">Register Student</a> /</li>
            <li class="active">Edit Student</li>
        </ol>
    </nav>

    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="studentId">Student ID</label>
                <input type="text" id="studentId" name="studentId" value="<?php echo htmlspecialchars($student['student_id']); ?>" required>
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
            </div>
            <button type="submit" class="btn">Update Student</button>
        </form>
    </div>
</main>

<?php
include('../partials/footer.php'); // Include the footer
?>
