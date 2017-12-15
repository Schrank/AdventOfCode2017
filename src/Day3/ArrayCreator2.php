<?php
declare(strict_types=1);

namespace AdventOfCode\Day3;

class ArrayCreator2
{
    private const NORTH = 'NORTH';
    private const SOUTH = 'SOUTH';
    private const WEST = 'WEST';
    private const EAST = 'EAST';
    /**
     * @var int[][]
     */
    private $field;

    /**
     * @param int $steps
     * @return int[][]
     */
    public function create(int $steps): array
    {
        $maxX        = 1;
        $maxY        = 1;
        $minX        = -1;
        $minY        = -1;
        $direction   = self::EAST;
        $array       = [];
        $i           = 0;
        $x           = $y = 0;
        $this->field = $array;
        while ($i < $steps) {
            $this->field[$x][$y] = $this->sumNeighbors($x, $y) ?: 1;
            if ($this->field[$x][$y] > $steps && $steps > 100) {
                throw new \Exception("Value {$this->field[$x][$y]} is higher then $steps.");
            }
            ++$i;
            if ($x === $maxX && $direction === self::EAST) {
                $direction = self::NORTH;
                $maxX++;
            }
            if ($x === $minX && $direction === self::WEST) {
                $direction = self::SOUTH;
                $minX--;
            }
            if ($y === $minY && $direction === self::NORTH) {
                $direction = self::WEST;
                $minY--;
            }
            if ($y === $maxY && $direction === self::SOUTH) {
                $direction = self::EAST;
                $maxY++;
            }
            switch ($direction) {
                case self::EAST:
                    $x++;
                    break;
                case self::WEST:
                    $x--;
                    break;
                case self::NORTH:
                    $y--;
                    break;
                case self::SOUTH:
                    $y++;
                    break;
            }
        }
        return $this->field;
    }

    public function countSteps($steps): int
    {
        foreach ($this->create($steps) as $x => $line) {
            foreach ($line as $y => $value) {
                if ($value === $steps) {
                    return abs($x) + abs($y);
                }
            }
        }
    }

    private function sumNeighbors($x, $y): int
    {
        $sum = 0;
        for ($i = -1; $i <= 1; $i++) {
            for ($j = -1; $j <= 1; $j++) {
                $sum += $this->field[$x + $i][$y + $j] ?? 0;
            }
        }
        return $sum;
    }
}
