<?php

class Solution {

    /**
     * @param Integer $n
     * @return String[]
     */
    function generateParenthesis($n) {
        $results = [];
        if ($n === 1) {
            $results[] = '()';
            return $results;
        }
        for ($i = 0; $i <= ($n - 1); ++$i) {
            $remaining = $n - 1 - $i;
            $subResults = $this->generateParenthesis($i);
            $otherResults = $this->generateParenthesis($remaining);
            $hasSubResults = false;
            foreach ($subResults as $subResult) {
                $hasSubResults = true;
                $hasOtherResults = false;
                foreach ($otherResults as $otherResult) {
                    $hasOtherResults = true;
                    $results[] = ('(' . $subResult . ')' . $otherResult);
                }
                if (!$hasOtherResults) {
                    $results[] = ('(' . $subResult . ')');
                }
            }
            if (!$hasSubResults) {
                $hasOtherResults = false;
                foreach ($otherResults as $otherResult) {
                    $hasOtherResults = true;
                    $results[] = ('()' . $otherResult);
                }
                if (!$hasOtherResults) {
                    $results[] = '()';
                }
            }
        }

        return $results;
    }
}

var_dump(
    (new Solution())->generateParenthesis(3)
);
