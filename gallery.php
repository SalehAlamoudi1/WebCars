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

// دالة عرض معرض الصور
function show_gallery() {
  global $conn;

  // استعلام قاعدة البيانات للحصول على جميع الصور
  $sql = "SELECT * FROM gallery";
  $result = $conn->query($sql);

  // عرض معرض الصور
  echo "<div class='gallery'>";
  while ($row = $result->fetch_assoc()) {
    echo "<div class='image-container'>
      <img src='" . $row['image_path'] . "' alt='" . $row['image_title'] . "'>
      <p>" . $row['image_title'] . "</p>
    </div>";
  }
  echo "</div>";
}

// تحقق من نوع الطلب
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // استدعاء دالة عرض معرض الصور
  show_gallery();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>معرض الصور</title>
  <link rel="stylesheet" href="style.css">
  <script src="script.js"></script>
</head>
<body>
  <div class="gallery-container">
    <h1>معرض الصور</h1>
    <?php show_gallery(); ?>
  </div>
</body>
</html>