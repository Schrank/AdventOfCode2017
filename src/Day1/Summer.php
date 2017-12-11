<?php
declare(strict_types=1);

namespace AdventOfCode\Day1;

class Summer
{
    public function sum($string, $distance)
    {
        $sum       = 0;
        $lastChar  = null;
        $charArray = str_split($string);
        $charArray = array_merge($charArray, $charArray);
        for ($i = 0, $iMax = strlen($string); $i < $iMax; $i++) {
            if ($charArray[$i + $distance] === $charArray[$i]) {
                $sum += $charArray[$i];
            }
        }
        return $sum;
    }
}
