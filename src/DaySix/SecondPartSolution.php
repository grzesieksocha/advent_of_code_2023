<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DaySix;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\String\Exploder;
use GrzesiekSocha\AdventOfCode2023\Utils\String\Modifier;

class SecondPartSolution implements SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $points = 1;
        $races = $this->getRaces($input);

        foreach ($races as $time => $winningDistance) {
            $a = floor(
                (
                    ($time - sqrt($time * $time - 4 * $winningDistance)) / 2
                ) + 1
            );
            $b = ceil(
                (
                    ($time + sqrt($time * $time - 4 * $winningDistance)) / 2
                ) - 1
            );

            $points *= (int) $b - (int) $a + 1;
        }

        return new Result($points);
    }

    /**
     * @return array<int, int>
     */
    private function getRaces(InputInterface $input): array
    {
        $times = $input->current()->value;
        $input->next();
        $distances = $input->current()->value;

        $times = Exploder::explodeBySpace(Exploder::explodeByAndGetPart(
            ':',
            Modifier::removeSpaces($times),
            1,
        ));

        $distances = Exploder::explodeBySpace(Exploder::explodeByAndGetPart(
            ':',
            Modifier::removeSpaces($distances),
            1,
        ));

        $distances = array_map(intval(...), $distances);

        return array_combine($times, $distances);
    }
}