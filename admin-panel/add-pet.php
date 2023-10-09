<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "1");
include('includes/config.php');

if(strlen($_SESSION['login']) == 0) { 
  header('location:index.php');
} else {
if (isset($_POST['submit'])) {
        // Function to validate and sanitize date input
function validate_date($input_date) {
    if (!empty($input_date)) {
        $date = date('Y-m-d', strtotime($input_date));
        return $date !== '1970-01-01' ? $date : null;
    }
    return null;
}

        // Function to sanitize input data
function sanitize_input($data) {
    if (isset($data) && !empty($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    return null;
}

// Check if the key 'v_date' exists in the $_POST array
$vaccination_date = validate_date($_POST["v_date"]);
$organization_unit = sanitize_input($_POST["org_unit"]);
$species = sanitize_input($_POST["species"]);
$sex_of_animal = sanitize_input($_POST["s_animal"]);
$pet_ownership = sanitize_input($_POST["pet_ownership"]);
$rabies_vaccination = sanitize_input($_POST["rabies_vaccination"]);
$animal_id = sanitize_input($_POST["animal_id"]);
$owner_first_name = sanitize_input($_POST["firstname"]);
$owner_last_name = sanitize_input($_POST["lastname"]);
$owner_phone = sanitize_input($_POST["phone"]);
$owner_address = sanitize_input($_POST["address"]);


// Prepare the SQL query to insert data into the "pet_data" table
$sql = "INSERT INTO pet_data (vaccination_date, organization_unit, species, sex_of_animal, pet_ownership, 
                              rabies_vaccination, animal_id, owner_first_name, owner_last_name, owner_phone, owner_address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Create a prepared statement
$stmt = $conn->prepare($sql);

// Bind parameters to the prepared statement
$stmt->bind_param("sssssssssss", $vaccination_date, $organization_unit, $species, $sex_of_animal, $pet_ownership,
                  $rabies_vaccination, $animal_id, $owner_first_name, $owner_last_name, $owner_phone, $owner_address);

                  if ($stmt->execute()) {
                    // Data inserted successfully
                    echo '<script>alert("Data inserted successfully.");</script>';
                } else {
                    // Error occurred while inserting data
                    echo '<script>alert("Error: ' . $conn->error . '");</script>';
                }
                

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
}
 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Pet | Rwanda Pets Registation Portal</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Summernote CSS Files -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">Welcome Admin!</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Admin</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Muramira & Co Advocates.</h6>
                            <span>Admin</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-person-bounding-box"></i><span>Pets</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="add-pet.php">
                            <i class="bi bi-circle"></i><span>Add Pet</span>
                        </a>
                    </li>
                    <li>
                        <a href="manage-pets.php">
                            <i class="bi bi-circle"></i><span>Manage Pets</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="bi bi-box-arrow-right"></i><span>Logout</span>
                </a>
            </li>

        </ul>

    </aside><!-- End Sidebar-->


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add Pet</h5>

                                <!-- Form -->
                                <form class="row g-3" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group m-b-20">
                                        <label for="species">Vaccination Date:</label>
                                        <input class="form-control valid" name="v_date" id="v_date" type="date"
                                            placeholder="Vaccination/Sterilization Date" required>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Organization Unit:</label>
                                        <input class="form-control valid" name="org_unit" id="org_unit" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Organization Unit'"
                                            placeholder="Organization Unit" required>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Species:</label>
                                        <input class="form-control" name="species" id="species" type="text"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Species'"
                                            placeholder="Species" required>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Sex Of Animal:</label>
                                        <select class="form-control" name="s_animal" id="s_animal">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="pet_ownership">Pet Ownership:</label>
                                        <select class="form-control" name="pet_ownership" id="pet_ownership">
                                            <option value="less_than_1">Less than 1 year old</option>
                                            <option value="1_to_5">1 to 5 years old</option>
                                            <option value="5_to_10">5 to 10 years old</option>
                                            <option value="over_10">Over 10 years old</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="rabies_vaccination">Rabies Vaccination:</label>
                                        <select class="form-control" name="rabies_vaccination" id="rabies_vaccination">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Animal ID:</label>
                                        <input class="form-control" name="animal_id" id="animal_id" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Unique Identifier Of Animal'"
                                            placeholder="Unique Identifier Of Animal">
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Owner First Name:</label>
                                        <input class="form-control valid" name="firstname" id="firstname" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Owner First Name'"
                                            placeholder="Owner First Name" required>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Owner Last Name:</label>
                                        <input class="form-control valid" name="lastname" id="lastname" type="text"
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Owner Last Name'" placeholder="Owner Last Name"
                                            required>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Owner Phone:</label>
                                        <input class="form-control valid" name="phone" id="phone" type="text"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Owner Phone'"
                                            placeholder="Owner Phone" required>
                                    </div>
                                    <div class="form-group m-b-20">
                                        <label for="species">Owner Address:</label>
                                        <input class="form-control valid" name="address" id="address" type="text"
                                            onfocus="this.placeholder = ''" onblur="this.placeholder = 'Owner Address'"
                                            placeholder="Owner Address" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form><!-- End Form -->
                            </div>
                        </div>
                    </div><!-- End Sales Card -->
                </div>
            </div><!-- End Left side columns -->
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright 2023 <strong><span>Rwanda Pets Registation Portal</span></strong>. All Rights Reserved
        </div>

    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>


</body>

</html>