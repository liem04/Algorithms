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
            $this->sort($a, $p, $r);
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
    private function partition(array &$a, int $p, int $r, int $x)
    {
        for ($i = $p; $i <= $r; $i++) {
            if ($a[$i] === $x) {
                $this->exchange($a, $i, $r);
                break;
            }
        }
        $i = $p - 1;
        for ($j = $p; $j <= $r - 1; $j++) {
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
            $this->sort($a, $startGroup, $endGroup);
            $medians[] = $a[($startGroup + $endGroup) / 2];
        }
        return $this->solve($medians, 0, count($medians) - 1, count($medians) / 2);
    }

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     */
    private function sort(array &$a, int $p, int $r)
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