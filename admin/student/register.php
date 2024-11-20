<?php
// Include necessary files
include('../../functions.php');  // Include the functions file
include('../partials/header.php');
include('../partials/side-bar.php');

$title = "Register a New Student"; // Set the title variable

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $studentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];

    // Register the student
    registerStudent($studentId, $firstName, $lastName);
}
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
    <h1 class="h2"><?php echo $title; ?></h1>

    <style>
     body {
    font-family: Arial, sans-serif;
    background-color: white;
    margin: 0;  /* Ensure no unexpected margin */
    padding: 0; /* Ensure no unexpected padding */
}

/* Ensure the container fits properly */
.container {
    width: 80%;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    min-height: auto;  /* Let the container's height adjust to its content */
}

/* Ensure the page takes up the full height of the screen */
main {
    min-height: 100vh;  /* Ensure the main content occupies at least the full viewport height */
    display: flex;
    flex-direction: column;
}

/* Adjustments for the heading */
.h2 {
    width: 60%;
    margin-left: 150px;
}

/* Breadcrumb style */
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

/* Form styling */
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

/* Button styling */
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

/* Student list container */
.student-list-container {
    margin-top: 40px;
    margin-left: 150px;
    max-height: 500px;  /* Limit table height */
    overflow-y: auto;  /* Enable vertical scrolling within the container */
}

/* Table styling */
.student-list table {
    width: 75%;
    border-collapse: collapse;
    table-layout: fixed;  /* Make table content size fixed */
}

.student-list th, .student-list td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
    word-wrap: break-word; /* Prevents long text from causing layout issues */
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

/* Action buttons */
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

/* Alert boxes */

/* Media query for smaller screens */
@media (max-width: 768px) {
    .h2 {
        width: 100%;
        margin-left: 0;
    }

    .breadcrumbs {
        width: 100%;
        margin-left: 0;
    }

    .student-list-container {
        margin-left: 0;
    }

    .student-list table {
        width: 100%;
    }

    .form-group button {
        width: 100%;
    }
}
    </style>

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register Student</li>
        </ol>
    </nav>

    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="studentId">Student ID</label>
                <input type="text" id="studentId" name="studentId" placeholder="Enter Student ID" >
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" id="firstName" name="firstName" placeholder="Enter First Name" >
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name" >
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
    </div>

    <div class="student-list-container container">
        <h3>Student List</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Retrieve all students from the database and display them
                $students = getStudents(); // Function to fetch students from the database
                foreach ($students as $student) {
                    echo "<tr>
                        <td>{$student['student_id']}</td>
                        <td>{$student['first_name']}</td>
                        <td>{$student['last_name']}</td>
                        <td>
                            <div class='action-buttons'>
                                <a href='edit_student.php?id={$student['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete_student.php?id={$student['id']}' class='btn btn-danger'>Delete</a>
                                <a href='attach_subject.php?id={$student['id']}' class='btn btn-info'>Attach Subject</a>
                            </div>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</main>

<?php
include('../partials/footer.php'); // Include the footer
?>
