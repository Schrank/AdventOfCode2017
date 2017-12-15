<?php
declare(strict_types=1);

namespace AdventOfCode\Day6;

class Reallocator
{
    /**
     * @var int[][]
     */
    private $knownConfigurations = [];

    /**
     * @var int[]
     */
    private $input;

    public function reallocate($input)
    {
        $steps       = 0;
        $this->input = $input;
        while (!$this->isKnownConfiguration($this->input)) {
            $this->knownConfigurations[] = $this->input;
            $this->reallocateBlocks();
            $steps++;
        }
        return $steps;
    }

    public function getLoopSize()
    {
        $occurence = array_search($this->input, $this->knownConfigurations);
        return count($this->knownConfigurations) - $occurence;
    }

    private function reallocateBlocks()
    {
        $maxKey               = $this->getKeyOfMax();
        $count                = count($this->input);
        $blocksToRelocate     = $this->input[$maxKey];
        $this->input[$maxKey] = 0;
        while ($blocksToRelocate > 0) {
            $this->input[++$maxKey % $count]++;
            $blocksToRelocate--;
        }
    }

    private function isKnownConfiguration($input)
    {
        return in_array($input, $this->knownConfigurations);
    }

    private function getKeyOfMax()
    {
        $maxValue = -1;
        $maxKey   = null;
        foreach ($this->input as $key => $value) {
            if ($value > $maxValue) {
                $maxKey   = $key;
                $maxValue = $value;
            }
        }
        return $maxKey;
    }
}
