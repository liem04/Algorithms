<?php

/**
 * @param string $filePath
 * @return array
 */
function readFileInput(string $filePath): array
{
    $handle = fopen($filePath, 'r') or die('Unable to open file: ' . $filePath);
    $row = 0;
    $appearedTimes = [];
    $heights = [];
    while (($line = fgets($handle)) !== false) {
        if ($row === 1) {
            $appearedTimes = explode(' ', trim($line));
        }
        if ($row === 2) {
            $heights = explode(' ', trim($line));
        }
        $row++;
    }
    fclose($handle);

    array_walk($appearedTimes, function (&$item) {
        $item = (int)$item;
    });

    array_walk($heights, function (&$item) {
        $item = (int)$item;
    });

    $animals = [];
    for ($i = 0; $i < count($heights); $i++) {
        $animals[] = [
            'index' => $i + 1,
            'appeared' => $appearedTimes[$i],
            'height' => $heights[$i],
        ];
    }

    return $animals;
}

/**
 * @param array $result
 * @param string $output
 */
function saveToOutput(array $result, string $output)
{
    $handler = fopen('output.txt', 'w') or die('Unable to open file: ' . $output);
    $totalCost = array_sum($result['cost']);
    fwrite($handler, $totalCost . PHP_EOL);
    fwrite($handler, implode(' ', $result['index']));
    fclose($handler);
}

/**
 * @param array $animals
 */
function sortAnimalsByAppearedTime(array &$animals)
{
    usort($animals, function ($a, $b) {
        if ($a['appeared'] == $b['appeared']) {
            return 0;
        }
        return ($a['appeared'] < $b['appeared']) ? -1 : 1;
    });
}

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

/**
 * @param array $canTapAnimals
 * @param array $animals
 * @param int $index
 * @param int $lastIndex
 */
function reloadCanTapAnimals(array &$canTapAnimals, array $animals, int $index, int &$lastIndex)
{
    while ($lastIndex < count($animals) && $animals[$lastIndex]['appeared'] <= $index + 1) {
        insertToSortedbyHeight($canTapAnimals, $animals[$lastIndex]);
        $lastIndex++;
    }
}

/**
 * @param array $canTapAnimals
 * @param array $result
 */
function tapSmallestHeightAnimal(array &$canTapAnimals, array &$result)
{
    if (count($canTapAnimals) === 0) {
        $result['index'][] = 0;
        return;
    }
    $smallestHeight = $canTapAnimals[0];
    $result['index'][] = $smallestHeight['index'];
    if ((int)$smallestHeight['height'] === 1) {
        array_shift($canTapAnimals);
        $result['cost'][] = count($result['index']);
    } else {
        $smallestHeight['height'] = $smallestHeight['height'] - 1;
        $canTapAnimals[0] = $smallestHeight;
    }
}

/**
 * @param array $animals
 * @return array
 */
function hammerSolver(array $animals): array
{
    sortAnimalsByAppearedTime($animals);
    $result = [];
    $canTapAnimals = [];
    $index = 0;
    $lastCanTapAnimalIndex = 0;
    $numberSolved = 0;
    while ($numberSolved < count($animals)) {
        reloadCanTapAnimals($canTapAnimals, $animals, $index, $lastCanTapAnimalIndex);
        tapSmallestHeightAnimal($canTapAnimals, $result);
        $numberSolved = isset($result['cost']) ? count($result['cost']) : 0;
        $index++;
    }
    return $result;
}

$animals = readFileInput('input.txt');
$timeStart = microtime(true);
$result = hammerSolver($animals);
echo 'Done with time: ' . (microtime(true) - $timeStart) . ' seconds';
saveToOutput($result, 'output.txt');