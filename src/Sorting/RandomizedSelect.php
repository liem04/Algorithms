<?php

namespace Algorithms\Sorting;

/**
 * Class RandomizedSelect
 */
class RandomizedSelect
{

    /**
     * @var RandomizedQuickSort
     */
    protected $randomizedQuicksort;

    /**
     * RandomizedSelect constructor.
     * @param RandomizedQuickSort $randomizedQuicksort
     */
    public function __construct(RandomizedQuickSort $randomizedQuicksort)
    {
        $this->ramdomizedQuicksort = $randomizedQuicksort;
    }

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
        $q = $this->ramdomizedQuicksort->partition($a, $p, $r);
        $k = $q - $p + 1;
        if ($i === $k) {
            return $a[$q];
        }
        if ($i < $k) {
            return $this->solve($a, $p, $q - 1, $i);
        }
        return $this->solve($a, $q + 1, $r, $i - $k);
    }
}