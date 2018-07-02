<?php

namespace core;


class Pattern
{
    static public function patternInt($value, $name = false): bool
    {
        return is_numeric($value) ?? (int)$value;
    }

    static public function patternString($value, $name = false): bool
    {
        return is_string($value) ?? (int)$value;
    }
}