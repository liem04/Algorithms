<?php

namespace Algorithms\Sorting;


/**
 * Class Heap
 * @package Algorithms\Sorting
 */
class Heap
{

    /**
     * @param int $i
     *
     * @return int
     */
    protected function parent(int $i): int
    {
        return ceil($i / 2) - 1;
    }

    /**
     * @param int $i
     *
     * @return int
     */
    protected function left(int $i): int
    {
        return 2 * $i + 1;
    }

    /**
     * @param int $i
     *
     * @return int
     */
    protected function right(int $i): int
    {
        return 2 * $i + 2;
    }
}