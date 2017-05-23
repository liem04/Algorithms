<?php

namespace Algorithms\KMin;


/**
 * Interface KMinInterface
 * @package KMin
 */
interface KMinInterface
{

    /**
     * @param array $a
     * @param int $k
     * @return array
     */
    public function solve(array $a, int $k): array;
}