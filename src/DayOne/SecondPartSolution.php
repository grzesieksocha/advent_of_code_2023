<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayOne;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;

class SecondPartSolution implements SolutionResolverInterface
{
    /** @var string[] */
    private const NUMBERS = [
        'one' => '1',
        'two' => '2',
        'three' => '3',
        'four' => '4',
        'five' => '5',
        'six' => '6',
        'seven' => '7',
        'eight' => '8',
        'nine' => '9',
    ];

    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $sum = 0;
        foreach ($input as $row) {
            $n1 = $this->findFirstNumber($row->value);
            $n2 = $this->findLastNumber($row->value);

            if ($n1 !== false && $n2 !== false) {
                $sum += (int) ($n1 . $n2);
            }
        }

        return new Result($sum);
    }

    private function findFirstNumber(string $s): string|false {
        $chars = str_split($s);
        $k = 0;
        $tmp = '';

        while ($k < strlen($s)) {
            if ((int) $chars[$k] > 0) {
                return $chars[$k];
            }

            $tmp .= $chars[$k];

            foreach (self::NUMBERS as $name => $value) {
                if (str_contains($tmp, $name)) {
                    return $value;
                }
            }

            $k++;
        }

        return false;
    }

    private function findLastNumber(string $s): string|false {
        $chars = str_split($s);
        $k = strlen($s) - 1;
        $tmp = [];

        while ($k >= 0) {
            if ((int) $chars[$k] > 0) {
                return $chars[$k];
            }

            array_unshift($tmp, $chars[$k]);

            foreach (self::NUMBERS as $name => $value) {
                if (str_contains(implode('', $tmp), $name)) {
                    return $value;
                }
            }

            $k--;
        }

        return false;
    }
}