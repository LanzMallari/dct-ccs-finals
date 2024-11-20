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
            margin: 0;
            padding: 0;
        }

        /* Main container styling */
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Breadcrumb styling */
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

        /* Submit button styling */
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

        

        /* Action buttons */
        .action-buttons a {
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .action-buttons .btn-warning {
            background-color: #ffc107;
        }

        .action-buttons .btn-danger {
            background-color: #dc3545;
        }

        .action-buttons .btn-info {
            background-color: #17a2b8;
        }

        .action-buttons a:hover {
            opacity: 0.9;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .breadcrumbs {
                width: 100%;
                margin-left: 0;
            }

            .form-group button {
                width: 100%;
            }

            .table {
                font-size: 14px;
            }
        }
    </style>

    <nav aria-label="breadcrumb" class="breadcrumbs">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
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
    <table class="table table-striped">
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

            if (empty($students)) {
                // If no students found, display a single row with the message
                echo "<tr>
                        <td colspan='4' style='text-align: center; font-weight: bold; color: #555;'>No student found</td>
                      </tr>";
            } else {
                foreach ($students as $student) {
                    echo "<tr>
                        <td>{$student['student_id']}</td>
                        <td>{$student['first_name']}</td>
                        <td>{$student['last_name']}</td>
                        <td>
                            <div class='action-buttons'>
                                <a href='edit.php?id={$student['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete.php?id={$student['id']}' class='btn btn-danger'>Delete</a>
                                <a href='attach_subject.php?id={$student['id']}' class='btn btn-info'>Attach Subject</a>
                            </div>
                        </td>
                    </tr>";
                }
            }
            ?>
        </tbody>
    </table>
</div>

</main>

<?php
include('../partials/footer.php'); // Include the footer
?>
