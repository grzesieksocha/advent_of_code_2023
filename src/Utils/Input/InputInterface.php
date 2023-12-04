<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\Input;

use GrzesiekSocha\AdventOfCode2023\Utils\Row;
use Iterator;

interface InputInterface extends Iterator
{
    public function current(): Row;
}