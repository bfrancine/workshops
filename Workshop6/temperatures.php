<?php
if ($argc > 0) {
    $temperatures = array(78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76, 73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73);

    $averageTemperature = array_sum($temperatures) / count($temperatures);

    $uniqueTemperatures = array_unique($temperatures);

    asort($uniqueTemperatures);
    $lowestTemperatures = array_slice($uniqueTemperatures, 0, 5);

    arsort($uniqueTemperatures);
    $highestTemperatures = array_slice($uniqueTemperatures, 0, 5);
    asort($highestTemperatures);

    echo "Average temperature is: " . $averageTemperature . "\n";
    echo "List of 5 lowest temperatures (no duplicates): " . implode(", ", $lowestTemperatures) . "\n";
    echo "List of 5 highest temperatures (no duplicates): " . implode(", ", $highestTemperatures) . "\n";
}