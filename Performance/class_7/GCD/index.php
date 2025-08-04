<?php
function gcd($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;}
$input = [12, 15, 18, 24, 28, 30];
$gcds = [];

for ($i = 0; $i < count($input); $i++) {
    for ($j = $i + 1; $j < count($input); $j++) {
        $g = gcd($input[$i], $input[$j]);
        if (!in_array($g, $gcds)) {
            $gcds[] = $g;
        }
    }
}
rsort($gcds);

if (count($gcds) < 2) {
    echo "No unique GCDs.";
} else {
    echo "2nd largest GCD among n elements: " . $gcds[1];
}
?>

