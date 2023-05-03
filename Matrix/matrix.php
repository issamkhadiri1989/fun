<?php

function display(array $m, int $n, int $k = 0)
{
  for ($i = $k; $i < $n - $k; $i++) {
    for ($j = $k; $j < $n - $k; $j++) {
      echo $m[$i][$j] . "\t\t";
    }
    echo "\n";
  }

  echo PHP_EOL."-----".PHP_EOL;
}

function rotate(array $input, array &$output, int $n, int $p = 0)
{
    if ($p === $n) {
        return;
    }

    if ($n % 2 === 0) {
        $center = $n / 2; 
        $output[$center][$center] = $input[$center][$center];
    }  
    
    $i = $p;
    for ($j = $p + 1; $j <= $n - $p; $j++) {
        $output[$i][$j]          = $input[$i][$j - 1];
        $output[$n - $i][$j - 1] = $input[$n - $i][$j];
    }
    
    $j = $n - $p;
    for ($i = $p + 1; $i <= $n - $p; $i++) {
        $output[$i][$j]         = $input[$i - 1][$j];
        $output[$i-1][$n - $j]  = $input[$i][$n  - $j];
    }

    rotate($input, $output, $n, $p + 1);
}

$input = require 'case1.php';

$count = count($input);

echo "INPUT = \n"; 
display($input, $count);

$output = [];

for ($k = 0 ; $k < $count; $k++) {
    $output[] = array_fill(0, $count, 'x');
}

$n = $count - 1;

rotate($input, $output, $n, 0);

echo "OUTPUT = \n"; 
display($output, $count);

