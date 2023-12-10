<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFive\Utils;

readonly class Range
{
    public function __construct(
        public int $from,
        public int $to,
    ) {
    }
}
