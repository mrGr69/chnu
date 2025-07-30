<?php

function generateTable($filename) {
    // Відкриваємо файл для читання
    $file = fopen($filename, "r") or die("Неможливо відкрити файл!");
    
    // HTML-код таблиці
    echo '<table>
        <tr>
            <th>№</th>
            <th>Назва області</th>
            <th>Населення (тис. осіб)</th>
            <th>Кількість ВНЗ</th>
            <th>Університетів на 100 тис. населення</th>
        </tr>';
    
    // Лічильник для нумерації рядків
    $counter = 1;
    
    // Читання даних з файлу та формування рядків таблиці
    while (!feof($file)) {
        // Отримуємо назву області/міста
        $region = trim(fgets($file));
        if (empty($region)) {
            continue; // Пропускаємо порожні рядки
        }
        
        // Отримуємо дані про населення
        $population = trim(fgets($file));
        if (empty($population)) {
            break; // Виходимо, якщо немає даних про населення
        }
        
        // Отримуємо дані про кількість ВНЗ
        $universities = trim(fgets($file));
        if (empty($universities)) {
            break; 
        }
        
        // Розраховуємо кількість студентів на 1 ВНЗ
        $studentsPerUniversity =  $universities / $population * 100;
        
        
        echo "<tr>
            <td>{$counter}</td>
            <td class='region-name'>{$region}</td>
            <td>{$population}</td>
            <td>{$universities}</td>
            <td>" . round($studentsPerUniversity, 2) . "</td>
        </tr>";
        
        $counter++;
    }
    
    
    echo '</table>';
    
    
    fclose($file);
}
?>