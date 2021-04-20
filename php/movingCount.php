<?php

class Solution {

    /**
     * @param Integer $m
     * @param Integer $n
     * @param Integer $k
     * @return Integer
     */
    function movingCount($m, $n, $k) {
        $digitsTotal = function ($number) {
            $total = 0;
            $numberStr = (string)$number;
            $numberStrLen = strlen($numberStr);
            for ($i = 0; $i < $numberStrLen; ++$i) {
                $total += ((int)$numberStr[$i]);
            }
            return $total;
        };

        $count = 0;
        $map = [];

        $searchFunc = null;
        $searchFunc = function ($location) use ($digitsTotal, &$map, $k, $m, $n, &$searchFunc, &$count) {
            $x = $location[0];
            $y = $location[1];

            if (isset($map[$x][$y])) {
                return;
            }
            $map[$x][$y] = 1;

            if ($x >= $n) {
                return;
            }
            if ($x < 0) {
                return;
            }
            if ($y >= $m) {
                return;
            }
            if ($y < 0) {
                return;
            }
            if (($digitsTotal($x) + $digitsTotal($y)) > $k) {
                return;
            }

            ++$count;

            $top = [$x, $y - 1];
            $searchFunc($top);

            $bottom = [$x, $y + 1];
            $searchFunc($bottom);

            $left = [$x - 1, $y];
            $searchFunc($left);

            $right = [$x + 1, $y];
            $searchFunc($right);
        };

        $searchFunc([0, 0]);

        return $count;
    }
}

var_dump(
    (new Solution())->movingCount(16, 8, 4)
);
