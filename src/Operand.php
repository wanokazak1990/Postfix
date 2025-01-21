<?php

namespace Spartak\Postfix;

Class Operand
{
    public const OPARR = [
        '+', '-', '*', '/', '^', '~'
    ];



    public static function isOperand(string $key) : bool
    {
        return in_array($key) ? 1 : 0;
    }



    public static function priority(string $key) : int
    {
        return match ($key) {
            '+' => 1,
            '-' => 1,
            '*' => 2,
            '/' => 2,
            '^' => 3,
            '~' => 4,
            default => throw new \Exception('Неизвестный оператор.'),
        };
    }
}