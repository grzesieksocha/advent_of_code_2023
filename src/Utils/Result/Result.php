<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\Result;

use GrzesiekSocha\AdventOfCode2023\Utils\ResultInterface;
use Stringable;

readonly class Result implements ResultInterface
{
    public function __construct(
        private Stringable|string $result,
    ) {
    }

    public function getResult(): string
    {
        return (string) $this->result;
    }
}