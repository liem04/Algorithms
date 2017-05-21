<?php
require_once 'InsertionSort.php';

/**
 * Class Select
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

    public function solve(array &$a, int $p, int $r, int $i)
    {
        if ($r - $p <= 5) {
            $this->insertionSort->sort($a, $p, $r);
            return $a[$i - 1];
        }
        $x = $this->getMedianFive($a, $p, $r);
        $q = $this->partition($a, $p, $r, $x);
        $this->display($a);
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
     * @param int $x
     * @return int
     */
    protected function partition(array &$a, int $p, int $r, int $x)
    {
        for ($i = $p; $i <= $r; $i++) {
            if ($a[$i] === $x) {
                $this->exchange($a, $i, $r);
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
        return $i + 1;
    }

    private function display(array $a)
    {
        echo implode(' ', $a) . PHP_EOL;
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

    private function getMedianFive(array $a, int $p, int $r)
    {
        $size = $r - $p;
        $medians = [];
        $groupNumber = ceil($size / 5);
        for ($i = 0; $i < $groupNumber; $i++) {
            $startGroup = $i * 5;
            $endGroup = (($i == $groupNumber - 1) ? $size - 1 : $i * 5 + 5);
            $this->insertionSort->sort($a, $startGroup, $endGroup);
            $medians[] = $a[($startGroup + $endGroup) / 2];
        }
        return $this->solve($medians, $p, count($medians) - 1, count($medians) / 2);
    }
}