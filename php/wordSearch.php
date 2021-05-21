<?php

class Solution {

    /**
     * @param String[][] $board
     * @param String $word
     * @return Boolean
     */
    function exist($board, $word) {
        $wordLen = strlen($word);
        $matched = false;
        $searchFunc = null;
        $searchFunc = function ($x, $y, $searched, $searchedStr, $index) use ($board, &$searchFunc, $word, $wordLen, &$matched) {
            if (!isset($board[$x][$y])) {
                return;
            }

            if (isset($searched[$x][$y])) {
                return;
            }
            $searched[$x][$y] = true;

            if (($index + 1) > $wordLen) {
                return;
            }

            $currentWord = $board[$x][$y];

            if ($word[$index] !== $currentWord) {
                return;
            }

            if (($searchedStr . $currentWord) === $word) {
                $matched = true;
                return;
            }

            //Up
            $newX = $x;
            $newY = $y - 1;
            $searchFunc($newX, $newY, $searched, $searchedStr . $currentWord, $index + 1);
            if ($matched) {
                return;
            }

            //Down
            $newX = $x;
            $newY = $y + 1;
            $searchFunc($newX, $newY, $searched, $searchedStr . $currentWord, $index + 1);
            if ($matched) {
                return;
            }

            //Left
            $newX = $x - 1;
            $newY = $y;
            $searchFunc($newX, $newY, $searched, $searchedStr . $currentWord, $index + 1);
            if ($matched) {
                return;
            }

            //Right
            $newX = $x + 1;
            $newY = $y;
            $searchFunc($newX, $newY, $searched, $searchedStr . $currentWord, $index + 1);
            if ($matched) {
                return;
            }
        };

        $maxRow = count($board);
        $maxCol = count($board[0]);
        for ($x = 0; $x < $maxRow; ++$x) {
            for ($y = 0; $y < $maxCol; ++$y) {
                if ($board[$x][$y] === $word[0]) {
                    $searchFunc($x, $y, [], '', 0);
                    if ($matched) {
                        break 2;
                    }
                }
            }
        }

        return $matched;
    }
}

var_dump(
    (new Solution())->exist(
        [["b","a","a","b","a","b"],["a","b","a","a","a","a"],["a","b","a","a","a","b"],["a","b","a","b","b","a"],["a","a","b","b","a","b"],["a","a","b","b","b","a"],["a","a","b","a","a","b"]],
        "aabbbbabbaababaaaabababbaaba"
    )
);
