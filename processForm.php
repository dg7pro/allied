<?php

// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions

$name       = @trim(stripslashes($_POST['name1']));
$from       = @trim(stripslashes($_POST['email1']));
$subject    = @trim(stripslashes($_POST['subject1']));
$message    = @trim(stripslashes($_POST['message1']));
//$to   		= 'email@email.com';//replace with your email

try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // May be 0,1,2 Enable verbose debug output.
    //$mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'dg7projects@gmail.com';                 // SMTP username
    $mail->Password = 'versache*07';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($from, $name);
    $mail->addAddress('alliedinfomedia@gmail.com', 'Allied Infomedia');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo($from, $name);
    //$mail->addCC('dgkashi@gmail.com');
    //$mail->addBCC('dgkashi@yahoo.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    $mail->send();
    //persistData($name,$from,$subject,$message);
    echo 'Message has been submitted successfully. We will contact you soon!';
} catch (Exception $e) {
    echo 'Sorry! Message could not be sent right now. Please try again later!';
    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

/*
 * Saving Enquiry TO THE DB
 */

function persistData($name,$from,$subject,$message){

    /*$servername = "localhost";
    $username = "root";
    $password = "mypass";
    $dbname = "allied";*/

    $servername = "localhost";
    $username = "nrbvxqpzjp";
    $password = "JeXT9CxeWU";
    $dbname = "nrbvxqpzjp";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Insert Query into DB
    $sql = "INSERT INTO `enquiry` (`name`, `email`, `subject`, `message`) VALUES ('$name', '$from', '$subject', '$message')";

    if (mysqli_query($conn, $sql)) {
        return true;
        //echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

// Connection closed
    mysqli_close($conn);

}

