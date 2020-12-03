<?php
declare(strict_types=1);

namespace AdventOfCode\Year2020\Day2;

class PasswordValidator
{

    public function validate(string $string)
    {
        [$rule, $password] = array_map('trim', explode(':', $string));
        //  1-3 b: cdefg
        [$allowedQty, $char] = explode(' ', $rule);
        [$min, $max] = explode('-', $allowedQty);

        $charCount = substr_count($password, $char);
        return $charCount >= $min && $charCount <= $max;
    }

    public function validate2($string)
    {
        [$rule, $password] = array_map('trim', explode(':', $string));
        //  1-3 b: cdefg
        [$letterPosition, $char] = explode(' ', $rule);
        [$first, $second] = explode('-', $letterPosition);

        return $password[$first - 1] === $char xor $password[$second - 1] === $char;
    }
}
