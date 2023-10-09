<?php
require_once('phpqrcode/qrlib.php');

// Fetch the pet data from the database based on the provided ID
if (isset($_GET['qr_id']) && isset($_GET['animal_id'])) {
    // Include the database connection file
    include('includes/config.php');

    // Sanitize the input to prevent SQL injection
    $pet_id = mysqli_real_escape_string($conn, $_GET['qr_id']);
    $animal_id = $_GET['animal_id'];

    // Retrieve the specific pet data from the database
    $sql = "SELECT * FROM pet_data WHERE id = '$pet_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Generate QR code content (using pet information)
        $qr_content = "Pet ID: " . $row['animal_id'] . "\n";
        $qr_content .= "Vaccination Date: " . $row['vaccination_date'] . "\n";
        $qr_content .= "Organization Unit: " . $row['organization_unit'] . "\n";
        $qr_content .= "Species: " . $row['species'] . "\n";
        $qr_content .= "Sex Of Animal: " . $row['sex_of_animal'] . "\n";
        $qr_content .= "Pet Ownership: " . $row['pet_ownership'] . "\n";
        $qr_content .= "Rabies Vaccination: " . $row['rabies_vaccination'] . "\n";
        $qr_content .= "Owner Name: " . $row['owner_first_name'] . "\n";
        $qr_content .= "Owner Phone: " . $row['owner_phone'] . "\n";
        $qr_content .= "Owner Address: " . $row['owner_address'] . "\n";
        // Set the QR code size and error correction level
        $qr_size = 150;
        $qr_error_correction = 'L';

        // Generate QR code image
        ob_start(); // Start output buffering to capture the QR code image
        QRcode::png($qr_content, false, $qr_error_correction, $qr_size);
        $qr_image_data = ob_get_contents(); // Get the QR code image data from output buffer
        ob_end_clean(); // Clean (close) the output buffer

        // Set the download file name
        $file_name = "QR_Code_Pet_" . $row['id'] . "_" . $animal_id . ".png";

        // Set the Content-Disposition header to force download
        header("Content-Disposition: attachment; filename=\"$file_name\"");
        header("Content-Type: image/png"); // Set the content type as image/png

        // Output the QR code image data
        echo $qr_image_data;
        exit;
    } else {
        // Pet data not found
        echo "Pet data not found.";
        exit;
    }
} else {
    // QR ID or owner name not provided
    echo "QR ID or owner name not provided.";
    exit;
}
?>
