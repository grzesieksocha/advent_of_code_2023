<?php

namespace GrzesiekSocha\AdventOfCode2023\DayTwo;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;

class SecondPartSolution implements SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $sumOfIds = 0;
        foreach ($input as $row) {
            $minimumRequirements = [
                'red' => 0,
                'green' => 0,
                'blue' => 0,
            ];

            $tries = array_map(trim(...), explode(':', $row->value))[1];
            $tries = array_map(trim(...), explode(';', $tries));
            foreach ($tries as $try) {
                foreach ($this->getMatches($try) as $color => $quantity) {
                    if ($quantity > $minimumRequirements[$color]) {
                        $minimumRequirements[$color] = $quantity;
                    }
                }
            }

            $sumOfIds += $minimumRequirements['red'] * $minimumRequirements['blue'] * $minimumRequirements['green'];
        }

        return new Result($sumOfIds);
    }

    public function setHelperValue(mixed $helperValue): void
    {
    }

    /**
     * @param string $helperValue
     *
     * @return int[]
     */
    private function getMatches(mixed $helperValue): array
    {
        preg_match_all('/(\d+)\s+(\w+)/', $helperValue, $matches);

        return array_combine($matches[2], $matches[1]);
    }
}