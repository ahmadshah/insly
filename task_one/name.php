<?php

$names = ['Ahmad', 'Shah', 'Hafizan', 'Hamidin'];
$fullname = '';

for  ($i=0; $i<count($names); $i++) {
    $fullname .= "{$names[$i]} ";
}

echo trim($fullname).PHP_EOL;