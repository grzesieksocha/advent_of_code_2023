<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFive;

use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\Range;
use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\RangeCollider;
use GrzesiekSocha\AdventOfCode2023\DayFive\Utils\RangeJoiner;
use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\String\Exploder;

class SecondPartSolution implements SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $mainMap = $input->current()->value;
        $mainMap = Exploder::explodeByAndGetPart(':', $mainMap, 1);
        $mainMap = Exploder::explodeByAndMap(' ', $mainMap, intval(...));

        $ranges = [];
        for ($i = 0; $i < count($mainMap); $i += 2) {
            $ranges[] = new Range($mainMap[$i], $mainMap[$i] + $mainMap[$i + 1] - 1);
        }

        $input->next();
        $input->next();
        $input->next();

        $ranges = $this->remap($input, $ranges); // soil
        $ranges = $this->remap($input, $ranges); // fertilizer
        $ranges = $this->remap($input, $ranges); // water
        $ranges = $this->remap($input, $ranges); // light
        $ranges = $this->remap($input, $ranges); // temperature
        $ranges = $this->remap($input, $ranges); // humidity
        $ranges = $this->remap($input, $ranges); // location

//        var_dump($ranges);

        $fromValues = array_map(fn(Range $range) => $range->from, $ranges);

        return new Result(min($fromValues));
    }

    public function remap(InputInterface $input, array $ranges): array
    {
        $newRanges = [];

        $mappers = [];
        while ($input->valid() && $input->current()->value !== '') {
            $mappingData = Exploder::explodeByAndMap(' ', $input->current()->value, intval(...));
            $range = $mappingData[2];
            $source = $mappingData[1];
            $destination = $mappingData[0];

            $mappers[] = [
                'sources' => new Range($source, $source + $range - 1),
                'change' => $destination - $source,
            ];

            $input->next();
        }

        $remaining = [];
        foreach ($mappers as $mapper) {
            [$remaining, $intersect] = RangeCollider::collide(
                $remaining === [] ? $ranges : $remaining,
                $mapper['sources']
            );

            foreach ($intersect as $intersectedRange) {
                $newRanges[] = new Range(
                    $intersectedRange->from + $mapper['change'],
                    $intersectedRange->to + $mapper['change'],
                );
            }
        }

        $newRanges = RangeJoiner::join(array_merge($remaining, $newRanges));

        $input->next();
        $input->next();

        return $newRanges;
    }
}