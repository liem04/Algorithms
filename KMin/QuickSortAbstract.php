<?php
require_once 'SortAbstract.php';

abstract class QuickSortAbstract extends SortAbstract
{
    /**
     * @param array $a
     * @param int $p
     * @param int $r
     */
    public function sort(array &$a, int $p, int $r)
    {
        if ($p < $r) {
            $q = $this->partition($a, $p, $r);
            $this->sort($a, $p, $q - 1);
            $this->sort($a, $q + 1, $r);
        }
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return int
     */
    public abstract function partition(array &$a, int $p, int $r);

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return int
     */
    protected function partitionPivotLast(array &$a, int $p, int $r)
    {
        $x = $a[$r];
        $i = $p - 1;
        for ($j = $p; $j <= $r - 1; $j++) {
            if ($a[$j] <= $x) {
                $i++;
                $this->exchange($a, $i, $j);
            }
        }
        $this->exchange($a, $i + 1, $r);
        return $i + 1;
    }
}