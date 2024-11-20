<?php
include('functions.php'); // Include the functions file

$errorMessage = ''; // Initialize error message variable

if (isset($_POST['login'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    if (loginUser($username, $password)) {
        header('Location: ./admin/dashboard.php');
        exit();
    } else {
        $errorMessage = "Invalid username or password."; // Set error message if login fails
    }
}
if (isset($_SESSION['email'])) {
    // Redirect to the dashboard if already logged in
    header("Location:./admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        .error-box {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .error-box h5 {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .error-box li {
            margin: 0;
            padding-left: 20px;
        }

        .error-box ul {
            list-style-type: none;
            padding-left: 0;
        }
    </style>
</head>

<body class="bg-secondary-subtle">
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-3">
            <!-- Display error message if any -->
            <?php if ($errorMessage): ?>
                <div class="error-box">
                    <h5>System Error</h5> <!-- Added bolded text above the list -->
                    <ul>
                        <li><?php echo $errorMessage; ?></li>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <h1 class="h3 mb-4 fw-normal">Login</h1>
                    <form method="post" action="">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="user1@example.com">
                            <label for="email">Email address</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                            <a href="database.php"></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
