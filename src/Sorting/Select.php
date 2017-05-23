<?php

namespace Algorithms\Sorting;

/**
 * Class Select
 * @package Algorithms\Sorting
 */
class Select
{

    use ArrayHelper;

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
            $this->insertionSort($a, $p, $r);
            return $a[$p + $i - 1];
        }
        $medianIndex = $this->getMedianIndex($a, $p, $r);
        $q = $this->partition($a, $p, $r, $medianIndex);
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
     * @param int $medianIndex
     * @return int
     */
    private function partition(array &$a, int $p, int $r, int $medianIndex)
    {
        $x = $a[$medianIndex];
        $this->exchange($a, $medianIndex, $r);
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

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     * @return int
     */
    private function getMedianIndex(array &$a, int $p, int $r): int
    {
        $size = $r - $p + 1;
        if ($size <= 5) {
            $this->insertionSort($a, $p, $r);
            return ($p + $r) / 2;
        }
        $groupNumber = ceil($size / 5);
        for ($i = 0; $i < $groupNumber; $i++) {
            $startGroup = $p + $i * 5;
            $endGroup = (($i == $groupNumber - 1) ? $r : $startGroup + 4);
            $this->insertionSort($a, $startGroup, $endGroup);
            $this->exchange($a, ($p + $i), ($startGroup + $endGroup) / 2);
        }

        return $this->getMedianIndex($a, $p, $p + $groupNumber - 1);
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     */
    private function insertionSort(array &$a, int $p, int $r)
    {
        for ($i = $p + 1; $i <= $r; $i++) {
            $key = $a[$i];
            $j = $i - 1;

            while ($j >= $p && $a[$j] > $key) {
                $a[$j + 1] = $a[$j];
                $j = $j - 1;
            }
            $a[$j + 1] = $key;
        }
    }
}