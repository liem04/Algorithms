<?php
namespace Algorithms\Sorting;

/**
 * Class RandomizedQuickSort
 */
class RandomizedQuickSort extends QuickSortAbstract
{

    use ArrayHelper;

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return int
     */
    public function partition(array &$a, int $p, int $r)
    {
        $i = random_int($p, $r);
        $this->exChange($a, $r, $i);
        return $this->partitionPivotLast($a, $p, $r);
    }
}