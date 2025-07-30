<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Статистика по областях України</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Статистика по областях України</h1>
    
    <?php
    // Підключаємо файл з функцією генерації таблиці
    require_once('table_generator.php');
    
    // Викликаємо функцію для створення таблиці
    generateTable('oblinfo__3.txt');
    ?>
    
</body>
</html>