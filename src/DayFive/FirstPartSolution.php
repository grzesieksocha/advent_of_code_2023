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

        $this->remap($input, $mainMap); // soil
        var_dump('soil done');
        $this->remap($input, $mainMap); // fertilizer
        var_dump('fertilizer done');
        $this->remap($input, $mainMap); // water
        var_dump('water done');
        $this->remap($input, $mainMap); // light
        var_dump('light done');
        $this->remap($input, $mainMap); // temperature
        var_dump('temperature done');
        $this->remap($input, $mainMap); // humidity
        var_dump('humidity done');
        $this->remap($input, $mainMap); // location

        return new Result(min($mainMap));
    }

    public function remap(InputInterface $input, array &$mainMap): void
    {
        $maxValue = max($mainMap);
        $minValue = min($mainMap);

        $mapper = [];
        while ($input->valid() && $input->current()->value !== '') {
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

        $mainMap = array_map(static fn($n) => $mapper[$n], $mainMap);
        $input->next();
        $input->next();
    }
}