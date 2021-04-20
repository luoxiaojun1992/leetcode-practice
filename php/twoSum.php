<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $diffMap = [];

        foreach($nums as $i => $num) {
            if (isset($diffMap[$num])) {
                return [$diffMap[$num], $i];
            }
            
            $diffMap[$target - $num] = $i;
        }
    }
}
