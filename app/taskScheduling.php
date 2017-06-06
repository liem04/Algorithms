<?php

function readFileInput($path)
{
    $handle = fopen($path, 'r') or die('Unable to open file!');
    $row = 0;
    $deadlines = [];
    $penalties = [];
    while (($line = fgets($handle)) !== false) {
        if ($row === 1) {
            $deadlines = explode(' ', trim($line));
        }
        if ($row === 2) {
            $penalties = explode(' ', trim($line));
        }
        $row++;
    }
    fclose($handle);
    return [$deadlines, $penalties];
}

function exchange(array &$a, int $i, int $j)
{
    $tmp = $a[$i];
    $a[$i] = $a[$j];
    $a[$j] = $tmp;
}

function parent(int $i): int
{
    return ceil($i / 2) - 1;
}

function left(int $i): int
{
    return 2 * $i + 1;
}

function right(int $i): int
{
    return 2 * $i + 2;
}

function maxHeapify(array &$a, array &$indexes, $i, int $size)
{
    $left = left($i);
    $right = right($i);
    $largest = $i;
    if ($left <= $size - 1 && $a[$left] > $a[$i]) {
        $largest = $left;
    }
    if ($right <= $size - 1 && $a[$right] > $a[$largest]) {
        $largest = $right;
    }
    if ($largest !== $i) {
        exchange($a, $i, $largest);
        exchange($indexes, $i, $largest);
        maxHeapify($a, $indexes, $largest, $size);
    }
}

function buildMaxHeap(array &$a, array &$indexes, int $size)
{
    for ($i = parent($size); $i >= 0; $i--) {
        maxHeapify($a, $indexes, $i, $size);
    }
}

function insert(array &$a, array &$indexes, $value, $index)
{
    $a[] = $value;
    $indexes[] = $index;
    $j = count($a) - 2;

    while ($j >= 0 && $a[$j] > $value) {
        $a[$j + 1] = $a[$j];
        $indexes[$j + 1] = $indexes[$j];
        $j = $j - 1;
    }
    $a[$j + 1] = $value;
    $indexes[$j + 1] = $index;
}

function writeOutput(array $result)
{
    $result = array_map(function ($item) {
        return $item = $item + 1;
    }, $result);
    $handler = fopen('output.txt', 'w') or die('Unable to open file!');
    fwrite($handler, implode(' ', $result));
    fclose($handler);
}

function greedy(array $deadlines, array $penalties)
{
    $tasks = array_keys($penalties);
    $earlyTasks = [];
    $earlyDeadlines = [];
    $lateTasks = [];
    $sortedDeadLines = [];
    $sortedTasks = [];
    $size = count($penalties);
    for ($i = 0; $i < $size; $i++) {
        buildMaxHeap($penalties, $tasks, count($penalties));
        exchange($penalties, 0, count($penalties) - 1);
        exchange($tasks, 0, count($tasks) - 1);
        array_pop($penalties);
        $taskIndex = array_pop($tasks);
        $deadline = $deadlines[$taskIndex];
        insert($sortedDeadLines, $sortedTasks, $deadline, $taskIndex);
        if (checkNoLateTask($sortedDeadLines)) {
            insert($earlyDeadlines, $earlyTasks, $deadline, $taskIndex);
        } else {
            $sortedDeadLines = $earlyDeadlines;
            $lateTasks[] = $taskIndex;
        }
    }

    return array_merge($earlyTasks, $lateTasks);
}

function checkNoLateTask(array $sortedDeadLines)
{
    $size = count($sortedDeadLines);
    for ($i = 0; $i < $size; $i++) {
        if ($sortedDeadLines[$i] < $i + 1) {
            return false;
        }
    }
    return true;
}


list($deadlines, $penalties) = readFileInput('input.txt');
$start = microtime(true);
$result = greedy($deadlines, $penalties);
echo 'Time: ' . (microtime(true) - $start) . PHP_EOL;
writeOutput($result);
echo 'Done! Write result to output.txt' . PHP_EOL;
