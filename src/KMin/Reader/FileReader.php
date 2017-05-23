<?php

namespace Algorithms\KMin\Reader;


/**
 * Class FileReader
 * @package Algorithms\KMin\Reader
 */
class FileReader
{

    /**
     * @param string $filePath
     * @return array
     */
    public function read(string $filePath): array
    {
        $handle = fopen($filePath, 'r') or die('Unable to open file!');
        $row = 0;
        $a = [];
        $k = 0;
        while (($line = fgets($handle)) !== false) {
            if ($row === 0) {
                list ($n, $k) = explode(' ', trim($line));
            } else {
                $a = explode(' ', trim($line));
            }
            $row++;
        }
        fclose($handle);
        $a = array_map(function($item) {
            return (int)$item;
        }, $a);
        return [$a, (int)$k];
    }
}