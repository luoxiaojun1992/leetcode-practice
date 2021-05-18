<?php

class Solution {

    /**
     * @param String[][] $grid
     * @return Integer
     */
    function numIslands($grid) {
        $duplicated = [];
        $m = count($grid);
        $n = count($grid[0]);

        $checkFunc = null;
        $checkFunc = function ($rowId, $colId) use (&$duplicated, $m, $n, &$grid, &$checkFunc) {
            $checkResult = true;

            if (isset($duplicated[$rowId][$colId])) {
                return $checkResult;
            }
            $duplicated[$rowId][$colId] = true;

            //left
            if ($colId - 1 >= 0) {
                if ($grid[$rowId][$colId - 1] !== '0') {
                    if (!$checkFunc($rowId, $colId - 1)) {
                        $checkResult = false;
                    }
                }
            }

            //right
            if (($colId + 1) < $n) {
                if ($grid[$rowId][$colId + 1] !== '0') {
                    if (!$checkFunc($rowId, $colId + 1)) {
                        $checkResult = false;
                    }
                }
            }

            //top
            if (($rowId - 1) >= 0) {
                if ($grid[$rowId - 1][$colId] !== '0') {
                    if (!$checkFunc($rowId - 1, $colId)) {
                        $checkResult = false;
                    }
                }
            }

            //bottom
            if (($rowId + 1) < $m) {
                if ($grid[$rowId + 1][$colId] !== '0') {
                    if (!$checkFunc($rowId + 1, $colId)) {
                        $checkResult = false;
                    }
                }
            }

            return $checkResult;
        };

        $islandCount = 0;

        foreach ($grid as $rowId => $row) {
            foreach ($row as $colId => $node) {
                if ($grid[$rowId][$colId] === '1') {
                    $duplicated = [];
                    if ($checkFunc($rowId, $colId)) {
                        $grid[$rowId][$colId] = '0';
                        foreach ($duplicated as $duplicatedRowId => $duplicatedRow) {
                            foreach ($duplicatedRow as $duplicatedColId => $duplicatedCol) {
                                $grid[$duplicatedRowId][$duplicatedColId] = '0';
                            }
                        }
                        ++$islandCount;
                    }
                }
            }
        }

        return $islandCount;
    }
}

var_dump(
    (new Solution())->numIslands(
        [
            ["1","1","0","0","0"],
            ["1","1","0","0","0"],
            ["0","0","1","0","0"],
            ["0","0","0","1","1"]
        ]
    )
);
