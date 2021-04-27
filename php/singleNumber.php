<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function singleNumber($nums) {
        sort($nums);
        foreach ($nums as $i => $num) {
            $isSingle = true;
            if (isset($nums[$i - 1])) {
                if ($nums[$i - 1] === $num) {
                    $isSingle = false;
                }
            }
            if ($isSingle) {
                if (isset($nums[$i + 1])) {
                    if ($nums[$i + 1] === $num) {
                        $isSingle = false;
                    }
                }
            }
            if ($isSingle) {
                return $num;
            }
        }
        return null;
    }
}

var_dump(
    (new Solution())->singleNumber([2,2,3,2])
);
