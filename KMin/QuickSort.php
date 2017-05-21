<?php
require_once 'QuickSortAbstract.php';

/**
 * Class QuickSort
 */
class QuickSort extends QuickSortAbstract
{
    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return int
     */
    public function partition(array &$a, int $p, int $r)
    {
        return $this->partitionPivotLast($a, $p, $r);
    }
}