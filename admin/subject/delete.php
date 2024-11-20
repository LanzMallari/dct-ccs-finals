<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Subject</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            height: 100vh;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            width: 600px;
            text-align: left;
        }
        .breadcrumbs {
            font-size: 14px;
            margin-bottom: 20px;
            width: 600px;
            text-align: left;
        }
        .breadcrumbs a {
            color: #6c757d; /* Blue-gray for inactive links */
            text-decoration: none;
        }
        .breadcrumbs a.active {
            color: #007bff; /* Blue for active links */
        }
        .breadcrumbs a:hover {
            text-decoration: underline;
        }
        .container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
            width: 600px;
        }
        .heading {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: left;
        }
        .details {
            text-align: left;
            margin: 20px 0;
            font-size: 16px;
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
        }
        .btn-cancel {
            background: #ccc;
            color: #000;
        }
        .btn-delete {
            background: #007bff;
            color: #fff;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">Delete Subject</div>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <a href="dashboard.php">Dashboard</a> / 
        <a href="add_subject.php">Add Subject</a> / 
        <a href="#" class="active">Delete Subject</a>
    </div>

    <!-- Main container -->
    <div class="container">
        <div class="heading">Are you sure you want to delete the following subject record?</div>
        <div class="details">
            <ul>
                <li><strong>Subject Code:</strong> </li>
                <li><strong>Subject Name:</strong> </li>
            </ul>
        </div>
        <div class="buttons">
            <button class="btn btn-cancel" onclick="window.location.href='dashboard.php'">Cancel</button>
            <form method="post" action="delete.php" style="display: inline;">
                <input type="hidden" name="subject_id" value="1001">
                <button type="submit" class="btn btn-delete">Delete Subject Record</button>
            </form>
        </div>
    </div>
</body>
</html>
