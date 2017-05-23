<?php

namespace Algorithms\Sorting;

/**
 * Class RandomizedSelect
 */
class RandomizedSelect
{

    use ArrayHelper;

    /**
     * RandomizedSelect constructor.
     * @param array $a
     * @param int $p
     * @param int $r
     * @param int $i
     * @return int
     */
    public function solve(array &$a, int $p, int $r, int $i)
    {
        if ($p === $r) {
            return $a[$p];
        }
        $q = $this->randomizedPartition($a, $p, $r);
        $k = $q - $p + 1;
        if ($i === $k) {
            return $a[$q];
        }
        if ($i < $k) {
            return $this->solve($a, $p, $q - 1, $i);
        }
        return $this->solve($a, $q + 1, $r, $i - $k);
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return int
     */
    protected function randomizedPartition(array &$a, int $p, int $r): int
    {
        $i = random_int($p, $r);
        $this->exchange($a, $r, $i);
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