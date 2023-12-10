<?php

declare(strict_types=1);

namespace DayFive\Utils;

use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\Range;
use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\RangeJoiner;
use PHPUnit\Framework\TestCase;

class RangeJoinerTest extends TestCase
{
    public function testJoin()
    {
        $r1 = new Range(1, 10);
        $r2 = new Range(11, 15);
        $r3 = new Range(17, 50);
        $r4 = new Range(35, 52);

        $joined = RangeJoiner::join([$r1, $r2, $r3, $r4]);

        var_dump($joined);

        self::assertSame(1, $joined[0]->from);
        self::assertSame(15, $joined[0]->to);
        self::assertSame(17, $joined[1]->from);
        self::assertSame(52, $joined[1]->to);
    }
}