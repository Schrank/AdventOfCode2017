<?php /** @noinspection IncrementDecrementOperationEquivalentInspection */

namespace AdventOfCode\Year2020\Day3;

class WayFinder
{

    public function find(string $map, $xInc = 3, $yInc = 1): int
    {
        $squares = explode("\n", trim($map));
        $y       = 0;
        $x       = 0;
        $trees   = 0;
        $height  = count($squares);
        $width   = strlen($squares[0]);

        for ($i = 0; ; $i++) {
            $x += $xInc;
            $y += $yInc;

            if ($y >= $height) {
                break;
            }

            if ($squares[$y][$x % $width] === '#') {
                $trees++;
            }
        }

        return $trees;
    }
}
