<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\InputInterface;

interface SolutionResolverInterface
{
    public function resolve(
        InputInterface $input,
    ): ResultInterface;
}