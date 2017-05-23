<?php

namespace Algorithms\Sorting;


/**
 * Class MinHeap
 * @package Algorithms\Sorting
 */
class MinHeap
{

    use ArrayHelper;

    /**
     * @param int $i
     *
     * @return int
     */
    private function parent(int $i): int
    {
        return ceil($i / 2) - 1;
    }

    /**
     * @param int $i
     *
     * @return int
     */
    private function left(int $i): int
    {
        return 2 * $i + 1;
    }

    /**
     * @param int $i
     *
     * @return int
     */
    private function right(int $i): int
    {
        return 2 * $i + 2;
    }

    /**
     * @param array $a
     * @param       $i
     * @param int $size
     */
    public function minHeapify(array &$a, $i, int $size)
    {
        $left = $this->left($i);
        $right = $this->right($i);
        $smallest = $i;
        if ($left <= $size - 1 && $a[$left] < $a[$i]) {
            $smallest = $left;
        }
        if ($right <= $size - 1 && $a[$right] < $a[$smallest]) {
            $smallest = $right;
        }
        if ($smallest !== $i) {
            $this->exchange($a, $i, $smallest);
            $this->minHeapify($a, $smallest, $size);
        }
    }

    /**
     * @param array $a
     * @param int $size
     */
    public function buildMixHeap(array &$a, int $size)
    {
        for ($i = $this->parent($size); $i >= 0; $i--) {
            $this->minHeapify($a, $i, $size);
        }
    }
}