<?php

class Solution {

    /**
     * @param Integer[][] $matrix
     * @return NULL
     */
    function setZeroes(&$matrix) {
        $rowCount = count($matrix);
        $colCount = count($matrix[0]);
        $zeroRow = [];
        $zeroCol = [];

        for ($row = 0; $row < $rowCount; ++$row) {
            for ($col = 0; $col < $colCount; ++$col) {
                if ($matrix[$row][$col] === 0) {
                    $zeroRow[$row] = true;
                    $zeroCol[] = $col;
                }
            }
        }

        for ($row = 0; $row < $rowCount; ++$row) {
            if (isset($zeroRow[$row])) {
                $matrix[$row] = array_pad([], $colCount, 0);
            } else {
                foreach ($zeroCol as $col) {
                    $matrix[$row][$col] = 0;
                }
            }
        }

        return null;
    }
}

$matrix = [[1,1,1],[1,0,1],[1,1,1]];
(new Solution())->setZeroes($matrix);
var_dump($matrix);
