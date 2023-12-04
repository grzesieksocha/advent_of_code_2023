<?php

declare(strict_types=1);

namespace GrzesiekSocha\AdventOfCode2023\Utils\Input;

use GrzesiekSocha\AdventOfCode2023\Utils\Row;

class StringConverter implements ConverterInterface
{
    public function convert(mixed $data): InputInterface
    {
        if (!$this->supports($data)) {
            throw new \LogicException('Unsupported type of $data');
        }

        $input = new RowCollectionInput();
        foreach (explode("\n", $data) as $row) {
            $input->addRow(new Row($row));
        }

        return $input;
    }

    public function supports(mixed $data): bool
    {
        return is_string($data);
    }
}