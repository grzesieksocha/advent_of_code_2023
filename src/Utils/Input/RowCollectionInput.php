<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\Input;

use GrzesiekSocha\AdventOfCode2023\Utils\Row;

class RowCollectionInput implements InputInterface
{
    /** @var Row[] */
    private array $rows = [];
    private int $position = 0;

    public function addRow(Row $row): self
    {
        $this->rows[] = $row;

        return $this;
    }

    public function current(): Row
    {
        return $this->rows[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->rows[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}