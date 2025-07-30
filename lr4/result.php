<?php
// Отримуємо обране напрямок
$direction = $_GET['direction'];

// Читаємо дані з файлу
$data = file('data.txt', FILE_IGNORE_NEW_LINES);
$found = false;
// Знаходимо вибране напрямок
$position = array_search($direction, $data);
if ($position !== false) {
    $university_count = (int)$data[$position + 1];
    $universities = array_slice($data, $position + 2, $university_count * 4);
}
?> 
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика по напрямку: <?php echo $direction; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="result">
        <h1 class="result__title">Статистика по напрямку: <?php echo $direction; ?></h1>
            <table class="result__table">
                <thead>
                    <tr>
                        <th>ВУЗ</th>
                        <th>Середній бал</th>
                        <th>Бюджет</th>
                        <th>Контракт</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 0; $i < count($universities); $i += 4): ?>
                        <tr>
                            <td><?php echo $universities[$i + 3]; ?></td>
                            <td><?php echo $universities[$i]; ?></td>
                            <td><?php echo $universities[$i + 1]; ?></td>
                            <td><?php echo $universities[$i + 2]; ?></td>
                        </tr>
                    <?php endfor; ?>
                </tbody>
            </table>
    </div>
</body>
</html>
