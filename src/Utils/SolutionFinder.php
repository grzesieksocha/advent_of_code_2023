<?php

namespace GrzesiekSocha\AdventOfCode2023\Utils;

class SolutionFinder
{
    public static function findSolutionResolver(
        string $day,
        string $part,
    ): SolutionResolverInterface|false {
        $className = sprintf(
            'GrzesiekSocha\\AdventOfCode2023\\Day%s\\%sPartSolution',
            ucfirst($day),
            ucfirst($part),
        );

        return class_exists($className) ? new $className() : false;
    }
}