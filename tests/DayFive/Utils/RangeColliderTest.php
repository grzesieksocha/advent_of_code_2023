<?php

declare(strict_types=1);

namespace DayFive\Utils;

use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\Range;
use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\RangeCollider;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class RangeColliderTest extends TestCase
{
    public function testCutRangesFromTwoParts()
    {
        $rangeOne = new Range(1, 10);
        $rangeTwo = new Range(20, 30);

        $cutOutRange = new Range(5, 25);

        [$leftovers, $cutOutParts] = RangeCollider::collide(
            [$rangeOne, $rangeTwo],
            $cutOutRange,
        );

        $leftOne = new Range(1, 4);
        $leftTwo = new Range(26, 30);

        $cutOne = new Range(5, 10);
        $cutTwo = new Range(20, 25);

        assertSame($leftOne->from, $leftovers[0]->from);
        assertSame($leftOne->to, $leftovers[0]->to);
        assertSame($leftTwo->from, $leftovers[1]->from);
        assertSame($leftTwo->to, $leftovers[1]->to);
        assertSame($cutOne->from, $cutOutParts[0]->from);
        assertSame($cutOne->to, $cutOutParts[0]->to);
        assertSame($cutTwo->from, $cutOutParts[1]->from);
        assertSame($cutTwo->to, $cutOutParts[1]->to);
    }

    public function testCutIntoThreeParts()
    {
        $range = new Range(1, 10);
        $cutOut = new Range(3, 6);

        [$leftovers, $cutOut] = RangeCollider::cut(
            $range,
            $cutOut,
        );

        $leftOne = new Range(1, 2);
        $leftTwo = new Range(7, 10);

        $cutOne = new Range(3, 6);

        assertSame($leftOne->from, $leftovers[0]->from);
        assertSame($leftOne->to, $leftovers[0]->to);
        assertSame($leftTwo->from, $leftovers[1]->from);
        assertSame($leftTwo->to, $leftovers[1]->to);
        assertSame($cutOne->from, $cutOut->from);
        assertSame($cutOne->to, $cutOut->to);
    }

    public function testCuttingBeforeRange()
    {
        $range = new Range(5, 10);
        $cutOutRange = new Range(1, 4);

        [$leftovers, $cutOut] = RangeCollider::cut(
            $range,
            $cutOutRange,
        );

        assertSame(5, $leftovers[0]-> from);
        assertSame(10, $leftovers[0]->to);
        assertSame(null, $cutOut);
    }

    public function testCuttingAfterRange()
    {
        $range = new Range(5, 10);
        $cutOutRange = new Range(11, 15);

        [$leftovers, $cutOut] = RangeCollider::cut(
            $range,
            $cutOutRange,
        );

        assertSame(5, $leftovers[0]-> from);
        assertSame(10, $leftovers[0]->to);
        assertSame(null, $cutOut);
    }

    public function testSimpleCuttingBeforeRange()
    {
        $range = new Range(5, 10);
        $cutOutRange = new Range(2, 7);

        [$leftovers, $cutOut] = RangeCollider::cut(
            $range,
            $cutOutRange,
        );

        assertSame(8, $leftovers[0]-> from);
        assertSame(10, $leftovers[0]->to);
        assertSame(5, $cutOut-> from);
        assertSame(7, $cutOut->to);
    }

    public function testSimpleCuttingAfterRange()
    {
        $range = new Range(5, 10);
        $cutOutRange = new Range(7, 15);

        [$leftovers, $cutOut] = RangeCollider::cut(
            $range,
            $cutOutRange,
        );
        assertSame(5, $leftovers[0]-> from);
        assertSame(6, $leftovers[0]->to);
        assertSame(7, $cutOut-> from);
        assertSame(10, $cutOut->to);
    }

    public function testSimpleCutAll()
    {
        $range = new Range(5, 10);
        $cutOutRange = new Range(1, 15);

        [$leftovers, $cutOut] = RangeCollider::cut(
            $range,
            $cutOutRange,
        );
        assertSame([], $leftovers);
        assertSame(5, $cutOut-> from);
        assertSame(10, $cutOut->to);
    }
}