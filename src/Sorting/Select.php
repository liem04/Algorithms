<?php

namespace Algorithms\Sorting;

/**
 * Class Select
 * @package Algorithms\Sorting
 */
class Select
{

    /**
     * @var InsertionSort
     */
    private $insertionSort;

    /**
     * Select constructor.
     * @param InsertionSort $insertionSort
     */
    public function __construct(InsertionSort $insertionSort)
    {
        $this->insertionSort = $insertionSort;
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @param int $i
     * @return mixed
     */
    public function solve(array &$a, int $p, int $r, int $i)
    {
        if ($r - $p <= 5) {
            $this->insertionSort->sort($a, $p, $r);
            return $a[$p + $i - 1];
        }
        $x = $this->getMedianFive($a, $p, $r);
        $q = $this->partition($a, $p, $r, $x);
        $k = $q - $p + 1;
        if ($i === $k) {
            return $a[$q];
        }
        if ($i < $k) {
            return $this->solve($a, $p, $q -1 , $i);
        }
        return $this->solve($a, $q + 1, $r, $i - $k);
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @param int $x
     * @return int
     */
    protected function partition(array &$a, int $p, int $r, int $x)
    {
        for ($i = $p; $i <= $r; $i++) {
            if ($a[$i] === $x) {
                $this->exchange($a, $i, $r);
                break;
            }
        }
        $i = $p - 1;
        for ($j = $p; $j <= $r; $j++) {
            if ($a[$j] <= $x) {
                $i++;
                $this->exchange($a, $i, $j);
            }
        }
        $this->exchange($a, $i + 1, $r);
        return $i;
    }

    /**
     * @param array $a
     * @param int $i
     * @param int $j
     */
    protected function exchange(array &$a, int $i, int $j)
    {
        $tmp = $a[$i];
        $a[$i] = $a[$j];
        $a[$j] = $tmp;
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return mixed
     */
    private function getMedianFive(array $a, int $p, int $r)
    {
        $size = $r - $p;
        $medians = [];
        $groupNumber = ceil($size / 5);
        for ($i = 0; $i < $groupNumber; $i++) {
            $startGroup = $p + $i * 5;
            $endGroup = (($i == $groupNumber - 1) ? $r : $startGroup + 4);
            $this->insertionSort->sort($a, $startGroup, $endGroup);
            $medians[] = $a[($startGroup + $endGroup) / 2];
        }
        return $this->solve($medians, 0, count($medians) - 1, count($medians) / 2);
    }
}