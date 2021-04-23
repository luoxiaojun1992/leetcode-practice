<?php

class Solution {

    /**
     * @param String[][] $board
     * @return NULL
     */
    function solve(&$board) {
        $duplicated = [];
        $m = count($board);
        $n = count($board[0]);

        $checkFunc = null;
        $checkFunc = function ($rowId, $colId) use (&$duplicated, $m, $n, $board, &$checkFunc) {
            $checkResult = true;

            if (isset($duplicated[$rowId][$colId])) {
                return $checkResult;
            }
            $duplicated[$rowId][$colId] = true;

            //left
            if ($colId - 1 >= 0) {
                if ($board[$rowId][$colId - 1] !== 'X') {
                    if (!$checkFunc($rowId, $colId - 1)) {
                        $checkResult = false;
                    }
                }
            } else {
                $checkResult = false;
            }

            //right
            if (($colId + 1) < $n) {
                if ($board[$rowId][$colId + 1] !== 'X') {
                    if (!$checkFunc($rowId, $colId + 1)) {
                        $checkResult = false;
                    }
                }
            } else {
                $checkResult = false;
            }

            //top
            if (($rowId - 1) >= 0) {
                if ($board[$rowId - 1][$colId] !== 'X') {
                    if (!$checkFunc($rowId - 1, $colId)) {
                        $checkResult = false;
                    }
                }
            } else {
                $checkResult = false;
            }

            //bottom
            if (($rowId + 1) < $m) {
                if ($board[$rowId + 1][$colId] !== 'X') {
                    if (!$checkFunc($rowId + 1, $colId)) {
                        $checkResult = false;
                    }
                }
            } else {
                $checkResult = false;
            }

            return $checkResult;
        };

        foreach ($board as $rowId => $row) {
            foreach ($row as $colId => $node) {
                if ($board[$rowId][$colId] === 'O') {
                    $duplicated = [];
                    if ($checkFunc($rowId, $colId)) {
                        $board[$rowId][$colId] = 'X';
                        foreach ($duplicated as $duplicatedRowId => $duplicatedRow) {
                            foreach ($duplicatedRow as $duplicatedColId => $duplicatedCol) {
                                $board[$duplicatedRowId][$duplicatedColId] = 'X';
                            }
                        }
                    }
                }
            }
        }

        return null;
    }
}

$board = [["X","X","X","X"],["X","O","O","X"],["X","X","O","X"],["X","O","X","X"]];
(new Solution())->solve($board);
var_dump($board);
