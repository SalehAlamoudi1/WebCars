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

// دالة إدارة المستخدمين
function manage_users() {
  global $conn;

  // استعلام قاعدة البيانات للحصول على جميع المستخدمين
  $sql = "SELECT * FROM users";
  $result = $conn->query($sql);

  // عرض قائمة المستخدمين
  echo "<table border='1'>
  <tr>
    <th>اسم المستخدم</th>
    <th>البريد الإلكتروني</th>
    <th>نوع المستخدم</th>
    <th>تعديل</th>
    <th>حذف</th>
  </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
      <td>" . $row['username'] . "</td>
      <td>" . $row['email'] . "</td>
      <td>" . $row['role'] . "</td>
      <td><a href='edit_user.php?id=" . $row['id'] . "'>تعديل</a></td>
      <td><a href='delete_user.php?id=" . $row['id'] . "'>حذف</a></td>
    </tr>";
  }
  echo "</table>";
}

// تحقق من دور المستخدم
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];

  // استعلام قاعدة البيانات للحصول على دور المستخدم
  $sql = "SELECT role FROM users WHERE username = '$username'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  // إذا كان المستخدم مسؤولاً، فاعرض صفحة إدارة المستخدمين
  if ($row['role'] == 'admin') {
    manage_users();
  } else {
    // إذا كان المستخدم مستخدمًا عاديًا، فقم بتوجيهه إلى الصفحة الرئيسية
    header("Location: index.php");
  }
} else {
  // إذا لم يكن المستخدم مسجلاً، فاعرض صفحة تسجيل الدخول أو تسجيل الاشتراك
  if (isset($_GET['page']) && $_GET['page'] == 'register') {
    // عرض صفحة تسجيل الاشتراك
    include 'register.php';
  } else {
    // عرض صفحة تسجيل الدخول
    include 'login.php';
  }
}
?>