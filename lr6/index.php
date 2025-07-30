<?php
function getPageContent($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $html = curl_exec($curl);
    curl_close($curl);
    return $html;
}

function extractBetween($html, $start, $end) {
    $pattern = '/' . preg_quote($start, '/') . '(.*?)' . preg_quote($end, '/') . '/s';
    preg_match($pattern, $html, $match);
    return trim(strip_tags($match[1] ?? 'Н/д'));
}


function getHoursWord($hours, $minutes) {
    if ($minutes == 0) {
        return "рівно $hours годин";
    }

    $hWord = ($hours == 1) ? "година" : (($hours >= 2 && $hours <= 4) ? "години" : "годин");
    return "$hours $hWord $minutes хв";
}

// URL для міста Харків або Київ
$url = "https://meteofor.com.ua/weather-kharkiv-5053/";
// $url = "https://meteofor.com.ua/weather-cherkasy-4956/"; // для Києва

$html = getPageContent($url);



$fullTitle = extractBetween($html, '<div class="page-title"><h1>', '</h1>');
$city = trim(str_replace('Погода', '', $fullTitle));
$date = date("d.m.Y");

// $date = extractBetween($html, '<div class="current-date">', '</div>');
$sunrise = extractBetween($html, '<div>Схід — ', '</div>');
$sunset = extractBetween($html, '<div>Захід — ', '</div>');
$duration = extractBetween($html, '<div class="astro-progress">Тривалість дня: ', '</div>');


// Розрахунок у форматі: рівно X годин / X годин Y хв
if (preg_match('/(\d+):(\d+)/', $duration, $timeParts)) {
    $hours = (int)$timeParts[1];
    $minutes = (int)$timeParts[2];
    $dayLengthText = getHoursWord($hours, $minutes);
} else {
    $dayLengthText = "Невідомо";
}

// парсим температуру по годинам
$temps = [];
preg_match_all('/<temperature-value[^>]*value="([+-]?\d+)"[^>]*>/i', $html, $tempMatches);
if (isset($tempMatches[1])) {
    $temps = array_slice($tempMatches[1], 0, 8); // беремо тіко перші 8 значень
}



?>


<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Прогноз погоди</title>
    <style>
        body { font-family: sans-serif; background: #f4f4f4; padding: 20px; }
        .block { background: white; padding: 20px; max-width: 600px; margin: auto; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        .block h1 { text-align: center; }
        .block table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .block td, .block th { padding: 8px; border-bottom: 1px solid #ccc; text-align: left; }
    </style>
</head>
<body>
    <div class="block">
        <h1>Погода: <?php echo $city; ?></h1>
        <!-- <p><strong>Дата:</strong> <?php echo $date; ?></p>
        -->
        <p><strong>Дата:</strong> <?php echo $date; ?></p>

        <p><strong>Схід сонця:</strong> <?php echo $sunrise; ?></p>
        <p><strong>Захід сонця:</strong> <?php echo $sunset; ?></p>
        <p><strong>Тривалість світлового дня:</strong> <?php echo $duration; ?></p>
        <h2>Температура по годинах</h2>
        <table>
            <tr>
                <th>Година</th>
                <th>Температура</th>
            </tr>
            <?php
            $hours = [0, 3, 6, 9, 12, 15, 18, 21];
            foreach ($temps as $i => $t) {
                echo "<tr><td>{$hours[$i]}:00</td><td>$t&deg;C</td></tr>";
            }
            ?>
        </table>
    </div>
    
    
</body>
</html>
