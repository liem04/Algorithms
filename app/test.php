<?php
require_once "MinHeightAnimalsQueue.php";

$queue = new MinHeightAnimalsQueue();

$animal1 = ['index'=>1, 'height' => 2];
$animal2 = ['index' => 2, 'height' => 10];
$animal3 = ['index' => 3, 'height' => 4];
$queue->insert($animal1, $animal1['height']);
$queue->insert($animal2, $animal2['height']);
$queue->insert($animal2, $animal2['height']);
var_dump($queue->count());
$x = $queue->extract();
var_dump($queue->count());
var_dump($x);
