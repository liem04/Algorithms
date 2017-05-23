<?php

namespace Algorithms\KMin;


use Algorithms\Sorting\HeapSort;

/**
 * Class UsingHeapSort
 * @package KMin
 */
class UsingHeapSort implements KMinInterface
{

    /**
     * @param array $a
     * @param int $k
     * @return array
     */
    public function solve(array $a, int $k): array
    {
        $heapSort = new HeapSort();
        $heapSort->sort($a);
        return array_slice($a, 0, $k);
    }
}