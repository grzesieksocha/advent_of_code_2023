<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Test\DaySeven;

use GrzesiekSocha\AdventOfCode2023\DaySeven\FirstPartSolution;
use GrzesiekSocha\AdventOfCode2023\Utils\Input\StringConverter;
use PHPUnit\Framework\TestCase;

class FirstPartSolutionTest extends TestCase
{
    public function testSolution(): void
    {
        $resolver = new FirstPartSolution();

        $data =
            <<<'DATA'
            32T3K 765
            T55J5 684
            KK677 28
            KTJJT 220
            QQQJA 483
            DATA;

        $input = (new StringConverter())->convert($data);

        $result = $resolver->resolve($input);

        self::assertSame('6440', $result->getResult());
    }
}