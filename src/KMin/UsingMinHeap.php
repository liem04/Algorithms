<?php

namespace Algorithms\KMin;


use Algorithms\Sorting\ArrayHelper;
use Algorithms\Sorting\MinHeap;

/**
 * Class UsingMinHeap
 * @package Algorithms\KMin
 */
class UsingMinHeap  implements KMinInterface
{

    use ArrayHelper;

    /**
     * @param array $a
     * @param int $k
     * @return array
     */
    public function solve(array $a, int $k): array
    {
        $minHeap = new MinHeap();
        $result = [];
        $minHeap->buildMixHeap($a, count($a));
        for ($i = 0; $i < $k; $i++) {
            $this->exchange($a, 0, count($a) - 1);
            $result[] = array_pop($a);
            $minHeap->minHeapify($a, 0, count($a));
        }
        return $result;
    }
}