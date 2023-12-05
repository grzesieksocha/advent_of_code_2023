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

        $mainMap = $this->remap($input, $mainMap); // soil
        $mainMap = $this->remap($input, $mainMap); // fertilizer
        $mainMap = $this->remap($input, $mainMap); // water
        $mainMap = $this->remap($input, $mainMap); // light
        $mainMap = $this->remap($input, $mainMap); // temperature
        $mainMap = $this->remap($input, $mainMap); // humidity
        $mainMap = $this->remap($input, $mainMap); // location

        return new Result(min($mainMap));
    }

    public function remap(InputInterface $input, array $mainMap): array
    {
        $mapper = [];
        while ($input->valid() && $input->current()->value !== '') {
            $mappingData = Exploder::explodeByAndMap(' ', $input->current()->value, intval(...));
            $range = $mappingData[2];
            $source = $mappingData[1];
            $destination = $mappingData[0];

            $mapper[] = [
                'range' => $range,
                'destination' => $destination,
                'from' => $source,
                'to' => $source + $range - 1,
            ];

            $input->next();
        }

        $tmpMap = [];
        foreach ($mainMap as $numberToMap) {
            $mechanismFound = false;
            $mappingMechanism = 'not found ^^';
            foreach ($mapper as $mappingMechanism) {
                if ($numberToMap >= $mappingMechanism['from'] && $numberToMap <= $mappingMechanism['to']) {
                    $mechanismFound = true;
                    break;
                }
            }

            $tmpMap[] = !$mechanismFound ? $numberToMap : $mappingMechanism['destination'] + $numberToMap - $mappingMechanism['from'];
        }

        $input->next();
        $input->next();

        return $tmpMap;
    }
}