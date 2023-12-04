<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFour;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\String\Exploder;
use GrzesiekSocha\AdventOfCode2023\Utils\String\Modifier;

class FirstPartSolution implements SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $points = 0;

        foreach ($input as $row) {
            $s = Modifier::singularSpaces($row->value);
            $games = Exploder::explodeByAndGetPart( ':', $s, 1);
            [$gameOne, $gameTwo] = Exploder::explodeBy('|', $games);
            $winningNumbers = Exploder::explodeByAndMap(' ', $gameOne, intval(...));
            $myNumbers = Exploder::explodeByAndMap(' ', $gameTwo, intval(...));

            $subSum = 0;
            foreach (array_intersect($myNumbers, $winningNumbers) as $winner) {
                $subSum = $subSum === 0 ? 1 : $subSum * 2;
            };

            $points += $subSum;
        }

        return new Result($points);
    }
}