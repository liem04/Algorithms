<?php
if (!defined('STDIN')) {
    echo 'Please run via command line';

    return;
}

$file = $argv[1]??'';
$tasks = readArrayFile(__DIR__ . '/' . $file);
$t = microtime(true);
$earlyTasks = greedy($tasks);
$content = printResult($tasks, $earlyTasks);
echo microtime(true) - $t;

//echo $content . PHP_EOL;

file_put_contents('output2.txt', $content);

function greedy(array $tasks)
{
    sortByWeight($tasks);
    $earlyTask = [];

    foreach ($tasks as $runIndex => $task) {
        if ($task['deadline'] >= $runIndex) {
            $earlyTask[] = $task['task'];
        }
    }

    return $earlyTask;
}

/**
 * @param array $tasks
 */
function sortByWeight(array &$tasks)
{
    $size = count($tasks);

    for ($j = 1; $j < $size; $j++) {
        for ($i = $j - 1; $i >= 0; $i--) {
            if ($tasks[$i]['weight'] < $tasks[$i + 1]['weight']) {
                exchange($tasks, $i, $i + 1);
            }
        }
    }
}

/**
 * @param array $tasks
 */
function sortByDeadline(array &$tasks)
{
    $size = count($tasks);

    for ($j = 1; $j < $size; $j++) {
        for ($i = $j - 1; $i >= 0; $i--) {
            if ($tasks[$i]['deadline'] > $tasks[$i + 1]['deadline']) {
                exchange($tasks, $i, $i + 1);
            }
        }
    }
}

/**
 * @param array $a
 * @param int $i
 * @param int $j
 */
function exchange(array &$a, int $i, int $j)
{
    $tmp = $a[$i];
    $a[$i] = $a[$j];
    $a[$j] = $tmp;
}

function printResult(array $tasks, array $earlyIndexes)
{
    $lateIndexes = [];
    foreach ($tasks as $task) {
        if (!in_array($task['task'], $earlyIndexes, true)) {
            $lateIndexes[] = $task['task'];
        }
    }

    sortByDeadline($tasks);

    $earlyIndexesSorted = [];
    foreach ($tasks as $task) {
        if (in_array($task['task'], $earlyIndexes, true)) {
            $earlyIndexesSorted[] = $task['task'];
        }
    }

    $content = implode(' ', $earlyIndexesSorted) . ' ' . implode(' ', $lateIndexes);

    return $content;
}

/**
 * @param string $source
 * @return array [size, k, array]
 */
function readArrayFile(string $source): array
{
    if (!file_exists($source)) {
        echo 'File does not exist:' . $source . PHP_EOL;
        die;
    }

    $fileContent = file_get_contents($source);
    $rows = explode(PHP_EOL, $fileContent);

    if (3 !== count($rows)) {
        echo 'Source file has invalid content' . PHP_EOL;
        die;
    }

    $size = (int)$rows[0];
    $deadlines = explode(' ', $rows[1]);
    $weights = explode(' ', $rows[2]);

    if ($size !== count($deadlines)) {
        echo 'invalid deadlines';
        die;
    }

    if ($size !== count($weights)) {
        echo 'invalid weights';
        die;
    }

    $tasks = [];

    for ($i = 0; $i < $size; $i++) {
        $tasks[] = [
            'task'     => $i + 1,
            'deadline' => $deadlines[$i],
            'weight'   => $weights[$i],
        ];
    }

    return $tasks;
}