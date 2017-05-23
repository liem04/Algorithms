<?php

namespace Algorithms\KMin;


use Algorithms\Sorting\RandomizedSelect;

/**
 * Class UsingRandomizedSelect
 * @package Algorithms\KMin
 */
class UsingRandomizedSelect implements KMinInterface
{

    /**
     * @param array $a
     * @param int $k
     * @return array
     */
    public function solve(array $a, int $k): array
    {
        $kmin = [];
        $randomizedSelect = new RandomizedSelect();
        for ($i = 1; $i <= $k; $i++)
        {
            $kmin[] = $randomizedSelect->solve($a, 0, count($a) - 1, $i);
        }
        return $kmin;
    }
}