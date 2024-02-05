<?php
session_start();

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

// دالة تسجيل الاشتراك
function register($username, $password, $email) {
  global $conn;

  // استعلام قاعدة البيانات للتحقق من وجود المستخدم
  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = $conn->query($sql);

  // إذا كان المستخدم غير موجود، فقم بإضافة المستخدم الجديد إلى قاعدة البيانات وتوجيهه إلى الصفحة الرئيسية
  if ($result->num_rows == 0) {
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
    $conn->query($sql);

    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    // إذا كان المستخدم موجودًا، فاعرض رسالة خطأ
    echo "اسم المستخدم موجود بالفعل";
  }
}

// تحقق من نوع الطلب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // استدعاء دالة تسجيل الاشتراك
  register($_POST['username'], $_POST['password'], $_POST['email']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الاشتراك</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <div class="register-container">
    <h1>تسجيل الاشتراك</h1>
    <form action="register.php" method="post">
      <label for="username">اسم المستخدم:</label>
      <input type="text" name="username" id="username">
      <br>
      <label for="password">كلمة المرور:</label>
      <input type="password" name="password" id="password">
      <br>
      <label for="email">البريد الإلكتروني:</label>
      <input type="email" name="email" id="email">
      <br>
      <input type="submit" value="تسجيل الاشتراك">
    </form>
  </div>
</body>
</html>