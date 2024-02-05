<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<div class="container">
        <h1>تسجيل بيانات الطالب</h1>
        <form action="index.php" method="post">
            <label for="name">الاسم:</label>
            <input type="text" id="name" name="name" br>

            <label for="age">العمر:</label>
            <input type="number" id="age" name="age" br>

            <label for="major">التخصص:</label>
            <input type="text" id="major" name="major" required>

            <label for="academic_level">المستوى الدراسي:</label>
            <input type="text" id="academic_level" name="academic_level" required>

            <label for="college">الكلية:</label>
            <input type="text" id="colleg" name="colleg" required>

            <button type="submit">تسجيل</button>
        </form>
</body>
</html>