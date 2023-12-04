<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayTwo;

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
        $helperValue = $this->getMatches('12 red, 13 green, 14 blue');

        $sumOfIds = 0;
        foreach ($input as $row) {
            $isGood = true;
            [$game, $tries] = Exploder::explodeByColon($row->value);
            $gameId = Exploder::explodeByAndGetPart(' ', $game, 1);
            $tries = Exploder::explodeBySemicolon($tries);
            foreach ($tries as $try) {
                foreach ($this->getMatches($try) as $color => $quantity) {
                    if ($quantity > $helperValue[$color]) {
                        $isGood = false;

                        break 2;
                    }
                }
            }

            $sumOfIds += $isGood ? $gameId : 0;
        }

        return new Result($sumOfIds);
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