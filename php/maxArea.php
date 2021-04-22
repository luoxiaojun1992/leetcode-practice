<?php

class Solution {

    /**
     * @param Integer[] $height
     * @return Integer
     */
    function maxArea($height)
    {
        $maxArea = 0;
        $lineCount = count($height);

        for ($i = 0, $j = $lineCount - 1; ($i < ($lineCount - 1)) && ($j > $i);) {
            $newArea = ($j - $i) * min($height[$i], $height[$j]);
            if ($newArea > $maxArea) {
                $maxArea = $newArea;
            }

            if ($height[$i] < $height[$j]) {
                ++$i;
            } else {
                --$j;
            }
        }

        return $maxArea;
    }
}

var_dump(
    (new Solution())->maxArea([1,2,3,4,5,25,24,3,4])
);
