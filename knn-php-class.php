<?php
class KNN {
    
    private $k;
    private $data;
    private $labels;

    public function __construct($k) {
        $this->k = $k;
        $this->data = array();
        $this->labels = array();
    }

    public function fit($X, $y) {
        $this->data = $X;
        $this->labels = $y;
    }

    public function predict($X) {
        $predictions = array();

        for ($i = 0; $i < count($X); $i++) {
            $distances = array();

            for ($j = 0; $j < count($this->data); $j++) {
                $distance = $this->euclideanDistance($X[$i], $this->data[$j]);
                $distances[$j] = array($distance, $this->labels[$j]);
            }

            usort($distances, function($a, $b) {
                return $a[0] - $b[0];
            });

            $kNearestNeighbors = array_slice($distances, 0, $this->k);
            $prediction = $this->majorityVote($kNearestNeighbors);
            $predictions[] = $prediction;
        }

        return $predictions;
    }

    private function euclideanDistance($a, $b) {
        $sum = 0;

        for ($i = 0; $i < count($a); $i++) {
            $sum += pow($a[$i] - $b[$i], 2);
        }

        return sqrt($sum);
    }

    private function majorityVote($neighbors) {
        $votes = array();

        foreach ($neighbors as $neighbor) {
            $label = $neighbor[1];

            if (array_key_exists($label, $votes)) {
                $votes[$label]++;
            } else {
                $votes[$label] = 1;
            }
        }

        arsort($votes);
        $mostCommonLabel = array_key_first($votes);

        return $mostCommonLabel;
    }

}
