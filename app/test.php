<?php


$animal1 = ['index'=>1, 'height' => 2];
$animal2 = ['index' => 2, 'height' => 6];
$animal3 = ['index' => 3, 'height' => 8];
$animal4 = ['index' => 3, 'height' => 1];
$animal5 = ['index' => 3, 'height' => 3];
$animal6 = ['index' => 3, 'height' => 5];

$a = [$animal1, $animal2, $animal3];
insertToSortedByHeight($a, $animal4);
insertToSortedByHeight($a, $animal5);
insertToSortedByHeight($a, $animal6);

/**
 * @param array $canTapAnimals
 * @param array $newAnimal
 */
function insertToSortedByHeight(array &$canTapAnimals, array $newAnimal)
{
    $canTapAnimals[] = $newAnimal;
    $j = count($canTapAnimals) - 2;

    while ($j >= 0 && $canTapAnimals[$j]['height'] > $newAnimal['height']) {
        $canTapAnimals[$j + 1] = $canTapAnimals[$j];
        $j = $j - 1;
    }
    $canTapAnimals[$j + 1] = $newAnimal;
}
