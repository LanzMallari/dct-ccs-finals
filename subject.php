<?php
$title = "Add a New Subject"; // Set the title variable
include('admin/partials/header.php'); // Include the header file
include('admin/partials/side-bar.php'); // Include the sidebar file
?>


<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-5">    
    <h1 class="h2"><php echo $title ?></h1>        
    <div class="container mt-5">
        <h2><?php echo $title; ?></h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register Subject</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subjectCode" name="subjectCode" placeholder="Subject Code">
                        <label for="subjectCode">Subject Code</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Subject Name">
                        <label for="subjectName">Subject Name</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Subject</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Subject List</h5>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Rows for subjects will be dynamically added later -->
                        <!-- Example row structure -->
                        <!--
                        <tr>
                            <td>1001</td>
                            <td>English</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm text-white">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                        -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN6jIeHz" crossorigin="anonymous"></script>

</main>


<?php
include('admin/partials/footer.php'); 
?>