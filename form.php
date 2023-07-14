<?php
$servername = "localhost:3306";
$username = "Lacledusucces";
$password = "Lacledusucces123!";
$dbname = "Lacledusucces-DB";
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

$sql = "INSERT INTO lacledusucces_table(`name`, gender, phoneNumber, `address`, email, profession, amountInvested, amountInvested,) 
VALUES ('$name', '$gender', '$phoneNumber', '$address', '$email', '$profession', '$amountInvested', '$package')";

// If the form is submitted successfully to database, then it will do this below

// Send email with form data
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php'; 
require 'PHPMailer/src/SMTP.php'; 

$mail = new PHPMailer();

$mail->IsSMTP();
$mail->SMTPAuth = true; 
$mail->Host = "localhost";
$mail->Port = 25;
$mail->Username = "admin@lacledusucces.org";
$mail->Password = "Lacledusucces123!";

$mail->SetFrom('admin@lacledusucces.org');
$mail->AddReplyTo("admin@lacledusucces.org");
$mail->Subject = "New Form Submitted";
$mail->MsgHTML("<html>

        <body>
        
        <em>Below is the details of the new record! </em><br><br><br>
        <strong>Name:</strong> $name`,<br><br>
        <strong>Gender:</strong> $gender,<br><br>
        <strong>Phone Number:</strong> $phoneNumber,<br><br>
        <strong>Full Address:</strong> $address`,<br><br>
        <strong>Email Address:</strong> $email,<br><br>
        <strong>Profession:</strong> $profession`,<br><br>
        <strong>Amount Invested:</strong> $amountInvested,<br><br>
        <strong>Package:</strong> $package,<br><br>
        
        </body>

    </html>");

$mail->AddAddress("admin@lacledusucces.org");

//If the form is submitted successfully
if (!$mail->Send()){

} elseif (mysqli_query($conn, $sql)){

}

// ADD THE LINK THAT THE USER SHOULD BE REDIRECTED TO BELOW AFTER SUBMISSION SUCCESSFUL
echo "<script>window.location.href = 'https:lacledusucces.org';</script>";


// Close connection

?>
