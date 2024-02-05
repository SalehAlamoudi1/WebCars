<?php
// اتصل بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cars_db";

// إنشاء اتصال بقاعدة البيانات
$conn = new mysqli($servername, $username, $password, $dbname);

// تحقق من الاتصال بقاعدة البيانات
if ($conn->connect_error) {
  die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// دالة إرسال رسالة الاتصال
function send_message($name, $email, $message) {
  global $conn;

  // استعلام قاعدة البيانات لإضافة رسالة الاتصال
  $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
  $conn->query($sql);

  // إرسال رسالة تأكيد إلى البريد الإلكتروني الخاص بالمستخدم
  $to = $email;
  $subject = "رسالة تأكيد الاتصال";
  $body = "شكرا لك على اتصالك بنا. سنرد عليك في أقرب وقت ممكن.";
  $headers = "From: you@example.com";

  mail($to, $subject, $body, $headers);

  // إعادة توجيه المستخدم إلى الصفحة الرئيسية
  header("Location: index.php");
}

// تحقق من نوع الطلب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // استدعاء دالة إرسال رسالة الاتصال
  send_message($_POST['name'], $_POST['email'], $_POST['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>اتصل بنا</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <div class="contact-container">
    <h1>اتصل بنا</h1>
    <form action="contact.php" method="post">
      <label for="name">الاسم:</label>
      <input type="text" name="name" id="name">
      <br>
      <label for="email">البريد الإلكتروني:</label>
      <input type="email" name="email" id="email">
      <br>
      <label for="message">الرسالة:</label>
      <textarea name="message" id="message"></textarea>
      <br>
      <input type="submit" value="إرسال">
    </form>
  </div>
</body>
</html>