<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\Input;

interface ConverterInterface
{
    public function convert(mixed $data): InputInterface;

    public function supports(mixed $data): bool;
}
