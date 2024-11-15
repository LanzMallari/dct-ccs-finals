<?php



$title = "Add a New Subject"; // Set the title variable
include('admin/partials/header.php'); // Include the header file
include('admin/partials/side-bar.php'); // Include the sidebar file
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
    <h1 class="h2"><php echo $title ?></h1>        
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
    margin-left: 150px; /* Adjust this value to control how much to the left */
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
    width: 100%; /* Set your desired width */
}


    </style>
</head>
<body>

<h2 class="h2">Register a New Student</h2>

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
            <input type="text" id="studentId" name="studentId" placeholder="Enter Student ID">
        </div>
        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" id="firstName" name="firstName" placeholder="Enter First Name">
        </div>
        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" id="lastName" name="lastName" placeholder="Enter Last Name">
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
            
            
        </tbody>
    </table>
</div>
</main>


<?php
include('admin/partials/footer.php'); 
?>