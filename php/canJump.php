<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function canJump($nums) {
        $numsCount = count($nums);
        $maxDistance = 0;

        foreach ($nums as $i => $distance) {
            if ($i <= $maxDistance) {
                $newMaxDistance = $i + $nums[$i];
                if ($newMaxDistance > $maxDistance) {
                    $maxDistance = $newMaxDistance;
                }
                if ($maxDistance >= ($numsCount - 1)) {
                    return true;
                }
            } else {
                return false;
            }
        }

        return false;
    }
}

var_dump(
    (new Solution())->canJump([3,0,8,2,0,0,1])
);
