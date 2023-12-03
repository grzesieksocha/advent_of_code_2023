<?php

namespace GrzesiekSocha\AdventOfCode2023\DayThree;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\StringConverter;
use PHPUnit\Framework\TestCase;

class TestSecondPartSolution extends TestCase
{
    public function testSolution1(): void
    {
        $resolver = new SecondPartSolution();

        $data =
            <<<'DATA'
            467..114..
            ...*......
            ..35..633.
            ......#...
            617*......
            .....+.58.
            ..592.....
            ......755.
            ...-.*....
            .664.598..
            DATA;

        $input = (new StringConverter())->convert($data);

        $result = $resolver->resolve($input);

        self::assertSame('467835', $result->getResult());
    }
}