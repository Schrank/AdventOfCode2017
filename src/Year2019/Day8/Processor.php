<?php
declare(strict_types=1);

namespace AdventOfCode\Day8;

class Processor
{
    /**
     * @var int[]
     */
    private $register = [];

    private $highestValueEver = PHP_INT_MIN;

    public function getRegister(): array
    {
        return $this->register;
    }

    /**
     * @param int[] $input
     * @return int
     */
    public function process(array $input): int
    {
        foreach ($input as $line) {
            preg_match('#([a-z]*) (inc|dec) (-?\d*) if ([a-z]*) (<|>|>=|<=|==|!=) (-?\d*)#', $line, $matches);

            $this->register[$matches[4]] = $this->register[$matches[4]] ?? 0;
            $this->register[$matches[1]] = $this->register[$matches[1]] ?? 0;

            $eval   = "return \$this->register['{$matches[4]}'] {$matches[5]} {$matches[6]};";
            $result = eval($eval);
            if (!$result) {
                continue;
            }

            if ($matches[2] === 'inc') {
                $this->register[$matches[1]] += $matches[3];
            } else {
                $this->register[$matches[1]] -= $matches[3];
            }
            $this->highestValueEver = max(array_merge($this->register, [$this->highestValueEver]));
        }

        return max($this->register);
    }

    public function getHighestValueEver(): int
    {
        return $this->highestValueEver;
    }
}
