<?php

class Solution {

    /**
     * @param String $text1
     * @param String $text2
     * @return Integer
     */
    function longestCommonSubsequence($text1, $text2) {
        $text1Len = strlen($text1);
        $text2Len = strlen($text2);

        $editDistance = [];
        $maxDistance = 0;

        for ($i = 0; $i < $text1Len; ++$i) {
            for ($j = 0; $j < $text2Len; ++$j) {
                if ($text1[$i] === $text2[$j]) {
                    $editDistance[$i][$j] = (isset($editDistance[$i - 1][$j - 1]) ? $editDistance[$i - 1][$j - 1] : 0) + 1;
                } else {
                    $editDistance[$i][$j] = max(
                        (isset($editDistance[$i - 1][$j]) ? $editDistance[$i - 1][$j] : 0),
                        (isset($editDistance[$i][$j - 1]) ? $editDistance[$i][$j - 1] : 0)
                    );
                }
                if ($editDistance[$i][$j] > $maxDistance) {
                    $maxDistance = $editDistance[$i][$j];
                }
            }
        }

        return $maxDistance;
    }
}

var_dump(
    (new Solution())->longestCommonSubsequence('pmjghexybyrgzczy', 'hafcdqbgncrcbihkd')
);
