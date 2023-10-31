<?php
include './includes/session.php';
if (isset($_POST['submit'])) {
    // Name of the file
    $filename = $_FILES['fileToUpload']['tmp_name'];

    // Temporary variable, used to store current query
    $templine = '';

    // Read in entire file
    $lines = file($filename);

    // Loop through each line
    foreach ($lines as $line) {

        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '') {
            continue;
        }

        // Add this line to the current segment
        $templine .= $line;

        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            mysqli_query($conn, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error() . '<br /><br />');
            // Reset temp variable to empty
            $templine = '';
        }
    }
    $_SESSION['importStatus'] = "Import success.";
    header('Location: database.php');
}
?>