<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\String;

class Exploder
{
    public static function explodeByAndMap(string $explodeBy, string $string, callable $map): array
    {
        return array_map($map, self::explodeBy($explodeBy, $string));
    }

    public static function explodeBy(string $explodeBy, string $string): array
    {
        return array_map(trim(...), explode($explodeBy, $string));
    }

    public static function explodeBySemicolon(string $string): array
    {
        return array_map(trim(...), explode(';', $string));
    }

    public static function explodeByColon(string $string): array
    {
        return array_map(trim(...), explode(':', $string));
    }

    public static function explodeByAndGetPart(string $explodeBy, string $string, int $part): string
    {
        return self::explodeBy($explodeBy, $string)[$part];
    }
}