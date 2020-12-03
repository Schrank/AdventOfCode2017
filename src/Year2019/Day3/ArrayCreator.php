<?php
declare(strict_types=1);

namespace AdventOfCode\Day3;

class ArrayCreator
{
    private const NORTH = 'NORTH';
    private const SOUTH = 'SOUTH';
    private const WEST = 'WEST';
    private const EAST = 'EAST';

    /**
     * @param int $steps
     * @return int[][]
     */
    public function create(int $steps): array
    {
        $maxX      = 1;
        $maxY      = 1;
        $minX      = -1;
        $minY      = -1;
        $direction = self::EAST;
        $array     = [];
        $i         = 0;
        $currentX  = $currentY = 0;
        while ($i < $steps) {
            $array[$currentX][$currentY] = ++$i;
            if ($currentX === $maxX && $direction === self::EAST) {
                $direction = self::NORTH;
                $maxX++;
            }
            if ($currentX === $minX && $direction === self::WEST) {
                $direction = self::SOUTH;
                $minX--;
            }
            if ($currentY === $minY && $direction === self::NORTH) {
                $direction = self::WEST;
                $minY--;
            }
            if ($currentY === $maxY && $direction === self::SOUTH) {
                $direction = self::EAST;
                $maxY++;
            }
            switch ($direction) {
                case self::EAST:
                    $currentX++;
                    break;
                case self::WEST:
                    $currentX--;
                    break;
                case self::NORTH:
                    $currentY--;
                    break;
                case self::SOUTH:
                    $currentY++;
                    break;
            }
        }
        return $array;
    }

    public function countSteps($steps)
    {
        foreach ($this->create($steps) as $x => $line) {
            foreach ($line as $y => $value) {
                if ($value === $steps) {
                    return abs($x) + abs($y);
                }
            }
        }
    }
}
