<?php
$region_id = (int)$_POST['region_id'];
$lines = file('oblinfo.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$index = $region_id * 3;
$name = trim($lines[$index]);
$population = trim($lines[$index + 1]);
$universities = trim($lines[$index + 2]);
$vnz_per_100k = round(($universities / $population) * 100, 2);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Інформація про область</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="result">
        <h1 class="result__title">Інформація про область</h1>
        <table class="result__table">
            <tr>
                <th class="result__th">Назва області</th>
                <td class="result__td"><?php echo $name; ?></td>
            </tr>
            <tr>
                <th class="result__th">Населення (тис.)</th>
                <td class="result__td"><?php echo $population; ?></td>
            </tr>
            <tr>
                <th class="result__th">Кількість ВНЗ</th>
                <td class="result__td"><?php echo $universities; ?></td>
            </tr>
            <tr>
                <th class="result__th">Число вузів на 100 тисяч Населення</th>
                <td class="result__td"><?php echo $vnz_per_100k; ?></td>
                </tr>
        </table>
    </div>
</body>
</html>
