<?php
$knn = new KNN(3);

$X = array(
    array(1, 2),
    array(3, 4),
    array(5, 6),
    array(7, 8),
    array(9, 10)
);

$y = array(0, 0, 1, 1, 1);

$knn->fit($X, $y);

$testX = array(
    array(2, 3),
    array(4, 5),
    array(6, 7),
    array(8, 9)
);

$predictions = $knn->predict($testX);

print_r($predictions); // outputs Array ( [0] => 0 [1] => 0 [2] => 1 [3] => 1 )
