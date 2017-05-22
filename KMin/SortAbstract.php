<?php

/**
 * Class SortAbstract
 */
abstract class SortAbstract
{
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
}