<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFive;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\String\Exploder;

class FirstPartSolution implements SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $mainMap = $input->current()->value;
        $mainMap = Exploder::explodeByAndGetPart(':', $mainMap, 1);
        $mainMap = Exploder::explodeByAndMap(' ', $mainMap, intval(...));

        $input->next();
        $input->next();
        $input->next();

        $maxValue = max($mainMap);
        $minValue = min($mainMap);

        $mapper = [];
        while ($input->current()->value !== '') {
            $mappingData = Exploder::explodeByAndMap(' ', $input->current()->value, intval(...));
            $range = $mappingData[2];
            $source = $mappingData[1];
            $destination = $mappingData[0];

            $finish = $source + $range;
            for ($s = $source; $s < $finish; $s++) {
                $mapper[$source] = $destination;
                $destination++;
                $source++;
            }

            $input->next();
        }

        for ($i = $minValue; $i <= $maxValue; $i++) {
            if (!isset($mapper[$i])) {
                $mapper[$i] = $i;
            }
        }

        $input->next();

        var_dump($mapper);
        $mainMap = array_map(static fn ($n) => $mapper[$n], $mainMap);

        var_dump($mainMap);

        return new Result(0);
    }
}