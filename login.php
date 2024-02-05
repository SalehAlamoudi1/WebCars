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

// دالة تسجيل الدخول
function login($username, $password) {
  global $conn;

  // استعلام قاعدة البيانات للتحقق من وجود المستخدم
  $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = $conn->query($sql);

  // إذا كان المستخدم موجودًا، فقم بتعيين جلسة المستخدم وتوجيهه إلى الصفحة الرئيسية
  if ($result->num_rows > 0) {
    $_SESSION['username'] = $username;
    header("Location: index.php");
  } else {
    // إذا لم يكن المستخدم موجودًا، فاعرض رسالة خطأ
    echo "اسم المستخدم أو كلمة المرور غير صحيحة";
  }
}

// تحقق من نوع الطلب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // استدعاء دالة تسجيل الدخول
  login($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <div class="login-container">
    <h1>تسجيل الدخول</h1>
    <form action="login.php" method="post">
      <label for="username">اسم المستخدم:</label>
      <input type="text" name="username" id="username">
      <br>
      <label for="password">كلمة المرور:</label>
      <input type="password" name="password" id="password">
      <br>
      <input type="submit" value="تسجيل الدخول">
    </form>
  </div>
</body>
</html>