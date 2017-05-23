<?php

namespace Algorithms\KMin;


use Algorithms\Sorting\InsertionSort;
use Algorithms\Sorting\Select;

class UsingSelect implements KMinInterface
{

    /**
     * @param array $a
     * @param int $k
     * @return array
     */
    public function solve(array $a, int $k): array
    {
        $kmin = [];
        $select = new Select();
        for ($i = 1; $i <= $k; $i++)
        {
            $kmin[] = $select->solve($a, 0, count($a) - 1, $i);
        }
        return $kmin;
    }
}