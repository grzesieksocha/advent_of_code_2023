<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\String;

class Modifier
{
    public static function singularSpaces(string $string): string
    {
        return preg_replace('/\s+/', ' ', $string);
    }

    public static function removeSpaces(string $string): string
    {
        return preg_replace('/\s+/', '', $string);
    }
}