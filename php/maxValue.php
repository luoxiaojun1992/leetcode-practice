<?php

class Solution {

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function maxValue($grid) {
        $valueMap = [];
        foreach ($grid as $x => $values) {
            foreach ($values as $y => $value) {
                $valueMap[$x][$y] = $value;
                $prevValue = 0;
                $prevX = $x - 1;
                $prevY = $y;
                if (isset($valueMap[$prevX][$prevY])) {
                    $prevValue = $valueMap[$prevX][$prevY];
                }
                $prevX = $x;
                $prevY = $y - 1;
                if (isset($valueMap[$prevX][$prevY])) {
                    if ($valueMap[$prevX][$prevY] > $prevValue) {
                        $prevValue = $valueMap[$prevX][$prevY];
                    }
                }
                $valueMap[$x][$y] += $prevValue;
            }
        }

        $maxValue = 0;
        foreach ($valueMap as $values) {
            foreach ($values as $value) {
                if ($value > $maxValue) {
                    $maxValue = $value;
                }
            }
        }

        return $maxValue;
    }
}

var_dump(
    (new Solution())->maxValue(
        [
            [1,2,3,4,5],
            [1,0,0,0,0],
            [1,2,3,4,0],
            [1,100,3,4,0],
            [1,2,3,4,0]
        ]
    )
);
