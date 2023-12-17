<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Test\DaySix;

use GrzesiekSocha\AdventOfCode2023\DaySix\FirstPartSolution;
use GrzesiekSocha\AdventOfCode2023\Utils\Input\StringConverter;
use PHPUnit\Framework\TestCase;

class FirstPartSolutionTest extends TestCase
{
    public function testSolution(): void
    {
        $resolver = new FirstPartSolution();

        $data =
            <<<'DATA'
            Time:      7  15   30
            Distance:  9  40  200
            DATA;

        $input = (new StringConverter())->convert($data);

        $result = $resolver->resolve($input);

        self::assertSame('288', $result->getResult());
    }
}