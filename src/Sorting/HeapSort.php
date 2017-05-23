<?php

namespace Algorithms\Sorting;

/**
 * Class HeapSort
 */
class HeapSort extends Heap
{

    use ArrayHelper;

    /**
     * @param array $a
     * @param       $i
     * @param int $size
     */
    public function maxHeapify(array &$a, $i, int $size)
    {
        $left = $this->left($i);
        $right = $this->right($i);
        $largest = $i;
        if ($left <= $size - 1 && $a[$left] > $a[$i]) {
            $largest = $left;
        }
        if ($right <= $size - 1 && $a[$right] > $a[$largest]) {
            $largest = $right;
        }
        if ($largest !== $i) {
            $this->exchange($a, $i, $largest);
            $this->maxHeapify($a, $largest, $size);
        }
    }

    /**
     * @param array $a
     * @param int $size
     */
    public function buildMaxHeap(array &$a, int $size)
    {
        for ($i = $this->parent($size); $i >= 0; $i--) {
            $this->maxHeapify($a, $i, $size);
        }
    }

    /**
     * @param array $a
     */
    public function sort(array &$a)
    {
        $length = count($a);
        $size = $length;
        $this->buildMaxHeap($a, $size);
        for ($i = $length - 1; $i > 0; $i--) {
            $this->exchange($a, 0, $i);
            $size--;
            $this->maxHeapify($a, 0, $size);
        }
    }
}