<?php

$f = 9; // исходное число

$result = (pow((1 + sqrt(5)) / 2, $f) - pow((1 - sqrt(5)) / 2, $f)) / sqrt(5);

echo "F({$f}) = " . $result;
