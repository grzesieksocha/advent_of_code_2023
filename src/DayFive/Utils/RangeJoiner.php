<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\DayFive\Utils;

class RangeJoiner
{
    /**
     * @param Range[] $ranges
     *
     * @return Range[]
     */
    public static function join(array $ranges): array
    {
        $outputRanges = [];

        $dataPoints = [];

        foreach ($ranges as $range) {
            $dataPoints[] = [
                'value' => $range->from,
                'type' => 'from',
            ];
            $dataPoints[] = [
                'value' => $range->to,
                'type' => 'to',
            ];
        }

        usort($dataPoints, fn($a, $b) => $a['value'] <=> $b['value']);

        $currentType = null;
        $currentFrom = null;
        $currentTo = null;

        foreach ($dataPoints as $dataPoint) {
            if ($currentType === null) {
                if ($dataPoint['type'] === 'from') {
                    $currentType = 'from';
                    $currentFrom = $dataPoint['value'];
                }

                if ($dataPoint['type'] === 'to') {
                    $currentType = 'to';
                    $currentTo = $dataPoint['value'];
                }

                continue;
            }

            if ($currentType === 'from' && $dataPoint['type'] === 'from') {
                continue;
            }

            if ($currentType === 'from' && $dataPoint['type'] === 'to') {
                $currentTo = $dataPoint['value'];
                $currentType = 'to';
                continue;
            }

            if ($currentType === 'to' && $dataPoint['type'] === 'to') {
                $currentTo = $dataPoint['value'];
                continue;
            }

            if ($currentType === 'to' && $dataPoint['type'] === 'from' && $dataPoint['value'] !== $currentTo + 1) {
                $outputRanges[] = new Range($currentFrom, $currentTo);

                $currentFrom = $dataPoint['value'];
                $currentTo = null;
                $currentType = 'from';
            }
        }

        if ($currentFrom !== null && $currentTo !== null) {
            $outputRanges[] = new Range($currentFrom, $currentTo);
        }

        return $outputRanges;
    }
}