<?php
include('../../functions.php');
guard(); // Ensure the user is logged in

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

// Handle the form submission for deleting the subject
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['subject_id']) && !empty($_POST['subject_id'])) {
        // Get the subject ID from the form
        $subject_id = $_POST['subject_id'];

        // Call the deleteSubject function to delete the subject from the database
        if (deleteSubject($subject_id)) {
            // Redirect to the subjects page with a success message
            header("Location: add.php?message=Subject Deleted Successfully");
            exit();
        } else {
            echo "<p style='color: red;'>Error deleting subject. Please try again.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Subject</title>
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
    <?php include('../partials/header.php'); ?>
    <?php include('../partials/side-bar.php'); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">
        <h2>Delete Subject</h2>
        
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb" class="breadcrumbs">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="add.php">Subjects</a></li>
                <li class="breadcrumb-item active" aria-current="page">Delete Subject</li>
            </ol>
        </nav>

        <!-- Delete Subject Form -->
        <div class="container">
            <div class="heading">Are you sure you want to delete the following subject record?</div>
            <div class="details">
                <ul>
                    <li><strong>Subject Code:</strong> <?php echo htmlspecialchars($subject['subject_code']); ?></li>
                    <li><strong>Subject Name:</strong> <?php echo htmlspecialchars($subject['subject_name']); ?></li>
                </ul>
            </div>
            <div class="buttons">
                <button class="btn btn-cancel" onclick="window.location.href='add.php'">Cancel</button>
                <form method="post" action="delete.php?id=<?php echo $id; ?>" style="display: inline;">
                    <input type="hidden" name="subject_id" value="<?php echo $id; ?>">
                    <button type="submit" class="btn btn-delete">Delete Subject Record</button>
                </form>
            </div>
        </div>
    </main>

    <?php include('../partials/footer.php'); ?>
</body>
</html>
