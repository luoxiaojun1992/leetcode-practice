<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function threeSum($nums) {
        $result = [];
        $resultMap = [];
        $target = 0;
        $numsCount = count($nums);

        foreach ($nums as $numIndex => $num) {
            $numsMap = [];
            $subTarget = $target - $num;

            for ($i = ($numIndex + 1); $i < $numsCount; ++$i) {
                $diff = $subTarget - $nums[$i];
                if (isset($numsMap[$diff])) {
                    $resultNums = [$num, $diff, $nums[$i]];
                    sort($resultNums);
                    if (!isset($resultMap[$resultNums[0]][$resultNums[1]][$resultNums[2]])) {
                        $result[] = $resultNums;
                        $resultMap[$resultNums[0]][$resultNums[1]][$resultNums[2]] = true;
                    }
                } else {
                    $numsMap[$nums[$i]] = true;
                }
            }
        }

        return $result;
    }
}

var_dump((new Solution())->threeSum([-1,0,1,2,-1,-4]));
