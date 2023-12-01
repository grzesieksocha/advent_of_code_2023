<?php

$fileHandle = fopen('./input.txt', 'r');
//$fileHandle = fopen('./test_input.txt', 'r');

/** @var int[] $data */
$data = [];
/** @var string[] $content */
$content = [];

$numbers = [
    'one' => '1',
    'two' => '2',
    'three' => '3',
    'four' => '4',
    'five' => '5',
    'six' => '6',
    'seven' => '7',
    'eight' => '8',
    'nine' => '9',
];

if ($fileHandle) {
    while (($line = fgets($fileHandle)) !== false) {
        $content[] = $line;
    }

    fclose($fileHandle);
} else {
    echo "Failed to open the file.";
}

foreach ($content as $string) {
    $digits = str_split(filter_var($string, FILTER_SANITIZE_NUMBER_INT));
    $n1 = findFirstNumber($string, $numbers);
    $n2 = findLastNumber($string, $numbers);

    if ($n1 !== false && $n2 !== false) {
        $data[] = (int) $n1 . $n2;
    }
}

$result = array_reduce($data, fn (int $c, int $n) => $c + $n, 0);

var_dump($result);

echo memory_get_peak_usage(true) / 1_048_576 . PHP_EOL;

function findFirstNumber(string $s, array $numbers): string|false {
    $chars = str_split($s);
    $k = 0;
    $tmp = '';

    while ($k < strlen($s)) {
        if ((int) $chars[$k] > 0) {
            return $chars[$k];
        }

        $tmp .= $chars[$k];

        foreach ($numbers as $name => $value) {
            if (str_contains($tmp, $name)) {
                return $value;
            }
        }

        $k++;
    }

    return false;
}

function findLastNumber(string $s, array $numbers): string|false {
    $chars = str_split($s);
    $k = strlen($s) - 1;
    $tmp = [];

    while ($k >= 0) {
        if ((int) $chars[$k] > 0) {
            return $chars[$k];
        }

        array_unshift($tmp, $chars[$k]);

        foreach ($numbers as $name => $value) {
            if (str_contains(implode('', $tmp), $name)) {
                return $value;
            }
        }

        $k--;
    }

    return false;
}
