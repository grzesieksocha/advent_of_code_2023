<?php

namespace GrzesiekSocha\AdventOfCode2023;

use GrzesiekSocha\AdventOfCode2023\Utils\Input\RowCollectionInput;
use GrzesiekSocha\AdventOfCode2023\Utils\Row;
use GrzesiekSocha\AdventOfCode2023\Utils\SolutionFinder;

require __DIR__ . '/../vendor/autoload.php';

$fileHandle = fopen(
    __DIR__ . sprintf('/Day%s/input.txt', $argv[1]),
    'r'
);

if ($fileHandle) {
    $data = new RowCollectionInput();
    while (($line = fgets($fileHandle)) !== false) {
        $data->addRow(new Row(trim($line)));
    }

    fclose($fileHandle);
} else {
    echo "Failed to open the file.";

    exit;
}

$solution = SolutionFinder::findSolutionResolver($argv[1], $argv[2]);
if (!$solution) {
    echo sprintf('Resolver for: Day \'%s\'; Part \'%s\' not found', 'one', 'first');

    exit;
}

$result = $solution->resolve($data);

echo $result->getResult() . PHP_EOL;
