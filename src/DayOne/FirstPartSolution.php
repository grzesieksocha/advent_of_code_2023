<?php

namespace GrzesiekSocha\AdventOfCode2023\DayOne;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;

class FirstPartSolution implements SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $sum = 0;
        foreach ($input as $row) {
            $digits = str_split(filter_var($row->value, FILTER_SANITIZE_NUMBER_INT));

            $sum += (int) ($digits[0] . $digits[array_key_last($digits)]);
        }

        return new Result((string) $sum);
    }

    public function setHelperValue(array $helperValue): void
    {
    }
}