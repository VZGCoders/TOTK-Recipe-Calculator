<?php
//require 'collection.php';
$csv = array_map('str_getcsv', file('materials.csv'));
$keys = array_shift($csv);
$keys[] = 'Classification';
$keys[] = 'RockHard';
$materials = array();
foreach ($csv as $row) {
    $lower = strtolower($row[1]); //Actor name sometimes contains classification
    $classification = 'Material';
    $rock_hard = TRUE;
    switch (TRUE) {
        case str_contains($lower, 'ore'):
            $classification = 'Ore';
            break;
        case str_contains($lower, 'insect'):
            $classification = 'Insect';
            $rock_hard = FALSE;
            break;
        case str_contains($lower, 'fruit'):
            $classification = 'Fruit';
            $rock_hard = FALSE;
            break;
        case str_contains($lower, 'fish'):
            $classification = 'Fish';
            $rock_hard = FALSE;
            break;
        case str_contains($lower, 'meat'):
            $classification = 'Meat';
            $rock_hard = FALSE;
            break;
        case str_contains($lower, 'mushroom'):
            $classification = 'Mushroom';
            $rock_hard = FALSE;
            break;
        case str_contains($lower, 'plant'):
            $classification = 'Plant';
            $rock_hard = FALSE;
            break;
        case str_contains($lower, 'enemy'):
            $classification = 'Monster';
            $rock_hard = FALSE;
            break;
    }
    $lower2 = strtolower($row[2]); //Euen name can sometimes be used to extrapolate classification, or have other exceptions
    switch (true) {
        case str_contains($lower2, 'seed'):
            $classification = 'Fruit';
            break;
        case str_contains($lower2, 'star'):
        case str_contains($lower2, 'dragon'):
            $classification = 'Extend Time';
            break;
    }
    $row[] = $classification;
    $row[] = $rock_hard;
    $materials[] = array_combine($keys, $row);
}
$materials_collection = new Collection([], $keys[2]);
foreach ($materials as $array) $materials_collection->pushItem($array);