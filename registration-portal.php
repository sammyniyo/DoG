<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
if (isset($_POST['submit'])) {
   
        // Database connection parameters
        $db_host = "localhost";
        $db_user = "root"; 
        $db_pass = ""; 
        $db_name = "rwanda_pet"; 

        // Create a database connection
        $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
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

// Execute the prepared statement
if ($stmt->execute()) {
    // Data inserted successfully
    echo '<div class="alert alert-success" role="alert">Data inserted successfully.</div>';
} else {
    // Error occurred while inserting data
    echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
 
}
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Registration Portal | Rwanda Pets Registation Portal</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/slicknav.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-3 col-lg-3">
                            <div class="logo">
                                <a href="index">
                                    <img src="img/waglogo.png" alt="" width="40%" height="40%">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-9">
                            <div class="main-menu  d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        <li><a href="index">home</a></li>
                                        <li><a href="about-us">about</a></li>
                                        <li><a href="services">services</a></li>
                                        <li class="active"><a href="registration-portal">Registation Portal</a></li>
                                        <li><a href="contact-us">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="contact-title">Get in Touch</h2>
                </div>
                <div class="col-lg-8">
                    <form class="form-contact" action="" method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="species">Vaccination Date:</label>
                                    <input class="form-control valid" name="v_date" id="v_date" type="date"
                                        placeholder="Vaccination/Sterilization Date" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="species">Organization Unit:</label>
                                    <input class="form-control valid" name="org_unit" id="org_unit" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Organization Unit'"
                                        placeholder="Organization Unit" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="species">Species:</label>
                                    <input class="form-control" name="species" id="species" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Species'"
                                        placeholder="Species" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="species">Sex Of Animal:</label>
                                    <select class="form-control" name="s_animal" id="s_animal">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="pet_ownership">Pet Ownership:</label>
                                    <select class="form-control" name="pet_ownership" id="pet_ownership">
                                        <option value="less_than_1">Less than 1 year old</option>
                                        <option value="1_to_5">1 to 5 years old</option>
                                        <option value="5_to_10">5 to 10 years old</option>
                                        <option value="over_10">Over 10 years old</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="rabies_vaccination">Rabies Vaccination:</label>
                                    <select class="form-control" name="rabies_vaccination" id="rabies_vaccination">
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="species">Animal ID:</label>
                                    <input class="form-control" name="animal_id" id="animal_id" type="text"
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Unique Identifier Of Animal'"
                                        placeholder="Unique Identifier Of Animal">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="species">Owner First Name:</label>
                                    <input class="form-control valid" name="firstname" id="firstname" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Owner First Name'"
                                        placeholder="Owner First Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="species">Owner Last Name:</label>
                                    <input class="form-control valid" name="lastname" id="lastname" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Owner Last Name'"
                                        placeholder="Owner Last Name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="species">Owner Phone:</label>
                                    <input class="form-control valid" name="phone" id="phone" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Owner Phone'"
                                        placeholder="Owner Phone" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="species">Owner Address:</label>
                                    <input class="form-control valid" name="address" id="address" type="text"
                                        onfocus="this.placeholder = ''" onblur="this.placeholder = 'Owner Address'"
                                        placeholder="Owner Address" required>
                                </div>
                            </div>

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" name="submit" class="button boxed-btn">Send</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-home"></i></span>
                        <div class="media-body">
                            <h3>KK 505 St</h3>
                            <p>Kigali, RWANDA</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                        <div class="media-body">
                            <h3><a href="tel:+250788610373">+250 788 61 0373</a></h3>
                            <p>Mon to Fri 8am to 5pm</p>
                        </div>
                    </div>
                    <div class="media contact-info">
                        <span class="contact-info__icon"><i class="ti-email"></i></span>
                        <div class="media-body">
                            <h3><a href="mailto:nradose@gmail.com">nradose@gmail.com</a></h3>
                            <p>Send us your query anytime!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer_start  -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Contact Us
                            </h3>
                            <ul class="address_line">
                                <li><a href="tel:+250788610373">+250 788 610 373</a></li>
                                <li><a href="mailto:nradose@gmail.com">nradose@gmail.com</a></li>
                                <li>KK 505 Kigali, Rwanda</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4  col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Our Services
                            </h3>
                            <ul class="links">
                                <li><a href="about-us">About Us</a></li>
                                <li><a href="services">Services</a></li>
                                <li><a href="registration-portal">Portal</a></li>
                                <li><a href="contact-us">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-3 ">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Our Location
                            </h3>
                            <p class="address_text">KK 505 Kigali, Rwanda
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="bordered_1px"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                        <p>
                            Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                            </script> Rwanda Pets Registration Portal | Powered By <a href="https://sammuhoza.com"
                                target="_blank">ByteGenius.</a>
                        </p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer_end  -->


    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/gijgo.min.js"></script>
</body>

</html>