<?php
// ส่งเข้า เมลล์
require_once('PHPMailer/PHPMailerAutoload.php'); //เรียกการใช้ phpmailer
$mail = new PHPMailer(); // Function mail
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "tls"; // ใช้งานรูปแบบ TTS TLS
$mail->Host = $getalert->alert_mail_server; // Domain mail
$mail->Port = 587;  // Port mail 25 : 587
$mail->isHTML();
$mail->CharSet = "utf-8"; // ตั้งเป็น UTF-8 เพื่อให้อ่านภาษาไทยได้
$mail->Username = $getalert->alert_mail_user; // ใส่เมลล์
$mail->Password = $getalert->alert_mail_pass; // ใส่รหัสผ่าน
$mail->SetFrom = ('no-reply@domaintest.com'); // Mail CC
$mail->FromName = "แจ้งการขอใช้บริการ IT"; // ชื่อที่ใช้ในการส่ง
$mail->Subject = "Ticket Number : " . $runticket;  // หัวเรื่อง Ticket
$mail->Body = $name_user . "<br>"; // รายละเอียดที่ส่ง
$mail->Body .= "แผนก : " . $department . "<br>";
$mail->Body .= "แจ้งปัญหาหมวดหมู่ของ : " . @prefixConvertorService($service) . "<br>";
$mail->Body .= "พบปัญาที่แจ้ง : " . @prefixConvertorServiceList($problem) . "<br>";
$mail->Body .= "รายละเอียด : " . $other . "<br>";
$mail->Body .= "วันที่ : " . $date_send . "<br>";
$mail->Body .= "ผู้แจ้ง : " . $namecall . "<br>";
$mail->Body .= "Link : " . @urllink() . "<br>";
$mail->AddAddress($getalert->alert_mail_get, 'เจ้าหน้าที่ที่เกี่ยวข้อง'); // อีเมลล์และชื่อผู้รับ

//ตรวจสอบว่าส่งผ่านหรือไม่
if ($mail->Send()) {
    $alert = $success;
    //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
} else {
    $alert = $success;
    //echo "<META HTTP-EQUIV='Refresh' CONTENT = '2; URL='" . $SERVER_NAME . "'>";
}
