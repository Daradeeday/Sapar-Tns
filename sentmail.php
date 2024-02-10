<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // รายละเอียดการเชื่อมต่อกับฐานข้อมูล
    $servername = "ชื่อเซิร์ฟเวอร์ฐานข้อมูล";
    $username = "ชื่อผู้ใช้ฐานข้อมูล";
    $password = "รหัสผ่านฐานข้อมูล";
    $dbname = "ชื่อฐานข้อมูล";

    // สร้างการเชื่อมต่อ
    $conn = new mysqli($servername, $username, $password, $dbname);

    // ตรวจสอบการเชื่อมต่อ
    if ($conn->connect_error) {
        die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
    }

    // คำสั่ง SQL เพื่อแทรกข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO contact_messages (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        // ส่งอีเมลแจ้งเตือน (ปรับแต่งส่วนนี้ตามความต้องการ)
        $to = "your_email@example.com";
        $subject = "มีการส่งข้อความจากแบบฟอร์มติดต่อ";
        $headers = "From: $email";

        $emailBody = "ชื่อ: $name\n";
        $emailBody .= "อีเมล: $email\n";
        $emailBody .= "โทรศัพท์: $phone\n";
        $emailBody .= "ข้อความ:\n$message";

        mail($to, $subject, $emailBody, $headers);

        echo "ขอบคุณ! ข้อความของคุณถูกส่งและบันทึกแล้ว.";
    } else {
        echo "ข้อผิดพลาด: " . $sql . "<br>" . $conn->error;
    }

    // ปิดการเชื่อมต่อกับฐานข้อมูล
    $conn->close();
} else {
    echo "คำขอไม่ถูกต้อง.";
}
?>
