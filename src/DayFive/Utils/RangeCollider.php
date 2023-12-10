<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFive\Utils;

readonly class RangeCollider
{
    /**
     * @param Range[] $baseRanges
     *
     * @return Range[][]
     */
    public static function collide(
        array $baseRanges,
        Range $cutOutRange,
    ): array {
        $leftovers = [];
        $cutOutParts = [];

        foreach ($baseRanges as $baseRange) {
            [$partLeftovers, $partCutOutParts] = self::cut($baseRange, $cutOutRange);

            $leftovers = $partLeftovers ? array_merge($leftovers, $partLeftovers) : $leftovers;
            $cutOutParts = $partCutOutParts ? array_merge($cutOutParts, [$partCutOutParts]) : $cutOutParts;
        }

        return [
            $leftovers,
            $cutOutParts,
        ];
    }

    /**
     * @return array{array<Range>, Range|null}
     */
    public static function cut(Range $baseRange, Range $cutOutRange): array
    {
        $leftovers = [];
        $cutOutPart = null;

        if ($cutOutRange->to < $baseRange->from) {
            return [
                [clone $baseRange],
                null,
            ];
        }

        if ($cutOutRange->from > $baseRange->to) {
            return [
                [clone $baseRange],
                null,
            ];
        }

        if ($cutOutRange->from <= $baseRange->from && $cutOutRange->to >= $baseRange->to) {
            $cutOutPart = clone $baseRange;
        }

        if ($cutOutRange->from > $baseRange->from && $cutOutRange->to < $baseRange->to) {
            $leftovers[] = new Range($baseRange->from, $cutOutRange->from - 1);
            $leftovers[] = new Range($cutOutRange->to + 1, $baseRange->to);
            $cutOutPart = new Range($cutOutRange->from, $cutOutRange->to);
        }

        if ($cutOutRange->from <= $baseRange->from && $cutOutRange->to < $baseRange->to) {
            $leftovers[] = new Range($cutOutRange->to + 1, $baseRange->to);
            $cutOutPart = new Range($baseRange->from, $cutOutRange->to);
        }

        if ($cutOutRange->from > $baseRange->from && $cutOutRange->to >= $baseRange->to) {
            $leftovers[] = new Range($baseRange->from, $cutOutRange->from - 1);
            $cutOutPart = new Range($cutOutRange->from, $baseRange->to);
        }

        return [
            $leftovers,
            $cutOutPart
        ];
    }
}
