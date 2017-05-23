<?php

namespace Algorithms\Sorting;

/**
 * Class InsertionSort
 */
class InsertionSort
{
    use ArrayHelper;

    /**
     * @param array $a
     * @param int $p
     * @param int $r
     */
    public function sort(array &$a, int $p, int $r)
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