<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayThree;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\Result\Result;
use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionResolverInterface;

class SecondPartSolution implements SolutionResolverInterface
{
    private const NUMBERS = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    public function resolve(
        InputInterface $input,
    ): ResultInterface {
        $numbers = [];
        $symbols = [];
        foreach ($input as $rowKey => $row) {
            $numberRow = null;
            $numberColumn = null;
            $number = '';

            $cells = str_split($row->value);
            foreach ($cells as $columnKey => $cellValue) {
                $lastNumber = $columnKey === count($cells) - 1;

                if (in_array($cellValue, self::NUMBERS)) {
                    $numberRow = $rowKey;
                    $numberColumn = $numberColumn !== null ? $numberColumn : $columnKey;
                    $number .= $cellValue;

                    if ($lastNumber) {
                        $numbers[] = [
                            'row' => $numberRow,
                            'column' => $numberColumn,
                            'number' => $number,
                        ];

                        $numberRow = null;
                        $numberColumn = null;
                        $number = '';
                    }

                    continue;
                } elseif ($numberColumn !== null) {
                    $numbers[] = [
                        'row' => $numberRow,
                        'column' => $numberColumn,
                        'number' => $number,
                    ];

                    $numberRow = null;
                    $numberColumn = null;
                    $number = '';
                }

                if ($cellValue !== '.') {
                    $symbols[$rowKey][$columnKey] = $cellValue;
                }
            }
        }

        $gears = [];
        foreach ($numbers as $numberData) {
            $row = $numberData['row'];
            $column = $numberData['column'];
            $number = $numberData['number'];
            for ($rk = $row - 1; $rk <= $row + 1; $rk++) {
                for ($ck = $column - 1; $ck <= $column + strlen($number); $ck++) {
                    if (isset($symbols[$rk][$ck]) && $symbols[$rk][$ck] === '*') {
                        $gears[sprintf('%s_%s', $rk, $ck)][] = (int) $number;
                    }
                }
            }
        }

        $sum = 0;
        foreach ($gears as $gear) {
            if (count($gear) === 2) {
                $sum += $gear[0] * $gear[1];
            }
        }

        return new Result($sum);
    }
}