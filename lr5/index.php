<?php
$lines = file('oblinfo.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$regions_count = count($lines) / 3; // Кожна область займає 3 рядки
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вибір області</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <h1 class="form__title">Оберіть область</h1>
        <form action="result.php" method="post" class="form__body">
            <select name="region_id" class="form__select">
                <?php 
                for ($i = 0; $i < $regions_count; $i++) {
                    $index = $i * 3;
                    $name = trim($lines[$index]);
                    echo "<option value=\"$i\">$name</option>";
                }
                ?>
            </select>
            <button type="submit" class="form__button">Відправити запит</button>
        </form>
    </div>
</body>
</html>
