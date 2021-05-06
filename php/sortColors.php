<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function sortColors(&$nums) {
        $start = 0;
        $numsCount = count($nums);
        $end = $numsCount - 1;

        $partitionFunc = null;
        $partitionFunc = function (&$nums, $start, $end) use (&$partitionFunc) {
            if ($start >= $end) {
                return;
            }

            $pivot = $end;
            for ($i = $start, $j = $start; $j < $end; ++$j) {
                if ($nums[$j] < $nums[$pivot]) {
                    $temp = $nums[$i];
                    $nums[$i] = $nums[$j];
                    $nums[$j] = $temp;
                    ++$i;
                }
            }
            $temp = $nums[$pivot];
            $nums[$pivot] = $nums[$i];
            $nums[$i] = $temp;
            $pivot = $i;

            $partitionFunc($nums, $start, $pivot - 1);
            $partitionFunc($nums, $pivot + 1, $end);
        };

        $partitionFunc($nums, $start, $end);

        return null;
    }
}

$nums = [2,0,2,1,1,0];
(new Solution())->sortColors($nums);
var_dump($nums);
