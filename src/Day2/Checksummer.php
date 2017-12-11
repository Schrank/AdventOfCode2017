<?php
declare(strict_types=1);

namespace AdventOfCode\Day2;

class Checksummer
{
    public function checksum(array $input)
    {
        $input = array_map(function ($input) {
            return str_replace("\t", ' ', $input);
        }, $input);
        $sum   = 0;
        foreach ($input as $line) {
            $values = explode(' ', $line);
            $values = array_map('trim', $values);
            $max    = max($values);
            $min    = min($values);
            $sum    += $max - $min;
        }
        return $sum;
    }
}
