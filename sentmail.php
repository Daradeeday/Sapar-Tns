<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // ต้องดาวน์โหลด PHPMailer ก่อนใช้งาน

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // ส่งอีเมล
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // แทนที่ด้วย SMTP server ของคุณ
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ddayrenger@gmail.com'; // แทนที่ด้วยชื่อผู้ใช้ SMTP ของคุณ
        $mail->Password   = ''; // แทนที่ด้วยรหัสผ่าน SMTP ของคุณ
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('your-email@example.com', 'Your Name'); // แทนที่ด้วยอีเมลและชื่อของคุณ
        $mail->addAddress('ddayrenger@gmail.com', 'Recipient Name'); // แทนที่ด้วยอีเมลและชื่อของผู้รับ

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name<br>Email: $email<br>Phone: $phone<br>Message: $message";

        $mail->send();
        echo 'Email has been sent!';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

    // เพิ่มโค้ด SQL สำหรับการบันทึกข้อมูลลงในฐานข้อมูล (ให้เปลี่ยนเป็นการเชื่อมต่อฐานข้อมูลของคุณ)
    $servername = "localhost";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // เพิ่มโค้ด SQL สำหรับการบันทึกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO your_table (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added to database successfully";
    } else {
        echo "Error adding record: " . $conn->error;
    }

    $conn->close();
}
?>
