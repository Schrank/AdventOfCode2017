<?php
declare(strict_types=1);

namespace AdventOfCode\Day4;

class PasswordFilter
{

    public function countValidPasswords(array $input): int
    {
        $count = 0;
        foreach ($input as $password) {
            $words = explode(' ', $password);
            $count += (int)$this->isValidPassword($words);
        }
        return $count;
    }

    public function countValidHardPasswords(array $input): int
    {
        $count = 0;
        foreach ($input as $password) {
            $words = explode(' ', $password);
            $count += (int)($this->isValidPassword($words) && $this->isValidHardPassword($words));
        }

        return $count;
    }

    private function isValidHardPassword($words): bool
    {
        foreach ($words as $a) {
            foreach ($words as $b) {
                if ($a === $b) {
                    continue;
                }
                if (count_chars($a, 1) === count_chars($b, 1)) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param $words
     * @return bool
     */
    private function isValidPassword($words): bool
    {
        return (\count($words) === \count(array_unique($words)));
    }
}
