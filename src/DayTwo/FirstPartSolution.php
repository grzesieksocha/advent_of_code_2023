<?php

namespace GrzesiekSocha\AdventOfCode2023\DayTwo;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;

class FirstPartSolution implements SolutionResolverInterface
{
    /** @var array<{'red': int, 'green': int, 'blue': int}> */
    private array $helperValue;

    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $sumOfIds = 0;
        foreach ($input as $row) {
            $isGood = true;
            [$game, $tries] = array_map(trim(...), explode(':', $row->value));
            $gameId = (int) explode(' ', $game)[1];
            $tries = array_map(trim(...), explode(';', $tries));
            foreach ($tries as $try) {
                foreach ($this->getMatches($try) as $color => $quantity) {
                    if ($quantity > $this->helperValue[$color]) {
                        $isGood = false;

                        break 2;
                    }
                }
            }

            $sumOfIds += $isGood ? $gameId : 0;
        }

        return new Result($sumOfIds);
    }

    public function setHelperValue(mixed $helperValue): void
    {
        $this->helperValue = $this->getMatches($helperValue);
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