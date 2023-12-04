<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFour;

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
        $cardData = [];
        foreach ($input as $key => $row) {
            $s = Modifier::singularSpaces($row->value);
            $games = Exploder::explodeByAndGetPart( ':', $s, 1);
            [$gameOne, $gameTwo] = Exploder::explodeBy('|', $games);
            $winningNumbers = Exploder::explodeByAndMap(' ', $gameOne, intval(...));
            $myNumbers = Exploder::explodeByAndMap(' ', $gameTwo, intval(...));

            $cardData[$key] = [
                'copies' => 1,
                'won' => count(array_intersect($myNumbers, $winningNumbers)),
            ];
        }

        $limit = count($cardData);
        $cardId = 0;
        while ($cardId < $limit) {
            for ($n = $cardId + 1; $n <= $cardId + $cardData[$cardId]['won']; $n++) {
                if (isset($cardData[$n])) {
                    $cardData[$n]['copies'] += $cardData[$cardId]['copies'];
                }
            }

            $cardId++;
        }

        $scratchcards = array_reduce($cardData, fn ($a, $v) => $a + $v['copies'], 0);
        return new Result((string) $scratchcards);
    }
}