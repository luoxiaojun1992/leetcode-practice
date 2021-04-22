<?php

class Solution {

    /**
     * @param Integer[][] $matrix
     * @return NULL
     */
    function rotate(&$matrix) {
        $n = count($matrix);

        for ($row = 0; $row < $n; ++$row) {
            for ($col = 0; $col < $n; ++$col) {
                if ($col >= $row) {
                    $swapRow = $col;
                    $swapCol = $row;
                    $tmp = $matrix[$row][$col];
                    $matrix[$row][$col] = $matrix[$swapRow][$swapCol];
                    $matrix[$swapRow][$swapCol] = $tmp;
                }
            }
        }

        for ($row = 0; $row < $n; ++$row) {
            $swapRow = $row;
            for ($col = 0; $col < floor($n / 2); ++$col) {
                $swapCol = $n - $col - 1;
                $tmp = $matrix[$row][$col];
                $matrix[$row][$col] = $matrix[$swapRow][$swapCol];
                $matrix[$swapRow][$swapCol] = $tmp;
            }
        }

        return null;
    }
}

$matrix = [[5,1,9,11],[2,4,8,10],[13,3,6,7],[15,14,12,16]];
(new Solution())->rotate($matrix);
var_dump($matrix);
