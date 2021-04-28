<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate(&$nums, $k) {
        $numsCount = count($nums);

        if ($k > $numsCount) {
            $k = $k % $numsCount;
        }

        if ($k === 0) {
            return null;
        }

        for ($i = $numsCount - 1, $j = $numsCount - 1 + $k; $i >= 0; --$i, --$j) {
            $nums[$j] = $nums[$i];
        }
        for ($i = 0; $i < $k; ++$i) {
            $nums[$i] = $nums[$numsCount + $i];
        }
        for ($i = $numsCount - 1 + $k; $i >= $numsCount; --$i) {
            unset($nums[$i]);
        }

        return null;
    }
}

$arr = [1,2,3,4,5,6,7];
(new Solution())->rotate($arr, 3);
var_dump(json_encode($arr));
