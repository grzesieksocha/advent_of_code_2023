<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DaySeven;

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
        $points = 1;

        $cards = [
            'A' => 14,
            'K' => 13,
            'Q' => 12,
            'J' => 11,
            'T' => 10,
            '9' => 9,
            '8' => 8,
            '7' => 7,
            '6' => 6,
            '5' => 5,
            '4' => 4,
            '3' => 3,
            '2' => 2,
        ];

        $ranks = [
            'five_of_a_kind' => 7,
            'four_of_a_kind' => 6,
            'full_house' => 5,
            'three_of_a_kind' => 4,
            'two_pairs' => 3,
            'one_pair' => 2,
            'high_card' => 1,
        ];

        $data = [];
        $highestRank = 7;
        foreach ($input as $line) {
            [$card, $bet] = Exploder::explodeBySpace($line->value);
            $rank = $this->rankCard($card);
            $highestRank = max($highestRank, $rank);
            $data[$rank][] = [
                'card' => $card,
                'bet' => $bet,
                'rank' => $rank,
            ];
        }


        return new Result($points);
    }

    private function rankCard(string $card): int
    {
        $cards = str_split($card);

        return 1;
    }
}