<?php
$servername = "localhost";
$username = "Lacledusucces";
$password = "ForgottenPassword";
$dbname = "form";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Escape user inputs for security
$name = mysqli_real_escape_string($conn, $_POST['name']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
$phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$profession = mysqli_real_escape_string($conn, $_POST['profession']);
$amountInvested = mysqli_real_escape_string($conn, $_POST['amountInvested']);
$package = mysqli_real_escape_string($conn, $_POST['package']);

// Attempt insert query execution

$sql = "INSERT INTO form_table (`name`, gender, phoneNumber, `address`, email, profession, amountInvested, package) VALUES ('$name', '$gender', '$phoneNumber', '$address', '$email', '$profession', '$amountInvested', '$package')";

if (mysqli_query($conn, $sql)) {
   
    $to = "admin@lacledusucces.org";
    $subject = "New Form Submitted";
    $message = "<html>
        <body>
            <em>Below are the details of the new record!</em><br><br><br>
            <strong>Name:</strong> $name,<br><br>
            <strong>Gender:</strong> $gender,<br><br>
            <strong>Phone Number:</strong> $phoneNumber,<br><br>
            <strong>Full Address:</strong> $address,<br><br>
            <strong>Email Address:</strong> $email,<br><br>
            <strong>Profession:</strong> $profession,<br><br>
            <strong>Amount Invested:</strong> $amountInvested,<br><br>
            <strong>Package:</strong> $package,<br><br>
        </body>
    </html>";

    $headers = "From: admin@lacledusucces.org\r\n";
    $headers .= "Reply-To: admin@lacledusucces.org\r\n";
    $headers .= "Content-Type: text/html\r\n";

    if (mail($to, $subject, $message, $headers)) {
        // Redirect user
        echo "<script>window.location.href = 'https://lacledusucces.org/';</script>";
    } else {
        // Display an error 
        echo "Email sending failed. Please try again later.";
    }
} else {
    // Display an error message or handle the query execution error
    echo "Query execution failed. Please try again later.";
}
