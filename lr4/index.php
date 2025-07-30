<?php
// Читаємо файл і сортуємо напрямки
$napr = file('napr.txt', FILE_IGNORE_NEW_LINES);
sort($napr);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вибір напрямку навчання</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <h1 class="form__title">Виберіть напрямок навчання</h1>
        <form action="result.php" method="get" class="form__select">
            <?php foreach ($napr as $direction): ?>
                <label class="form__label">
                    <input type="radio" name="direction" value="<?php echo $direction; ?>" class="form__input">
                    <?php echo $direction; ?>
                </label><br>
            <?php endforeach; ?>
            <button type="submit" class="form__button">Отримати статистику</button>
        </form>
    </div>
</body>
</html>
