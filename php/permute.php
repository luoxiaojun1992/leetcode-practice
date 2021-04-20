<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[][]
     */
    function permute($nums) {
        $combinations = [];
        foreach ($nums as $numIndex => $num) {
            $subNums = [];
            foreach ($nums as $subNumIndex => $subNum) {
                if ($subNumIndex === $numIndex) {
                    continue;
                }
                $subNums[] = $subNum;
            }
            if (count($subNums) > 0) {
                $subCombinations = $this->permute($subNums);
                foreach ($subCombinations as $subCombinationIndex => $subCombination) {
                    $combinations[] = array_merge([$num], $subCombination);
                }
            } else {
                $combinations[] = [$num];
            }
        }
        return $combinations;
    }
}

var_dump((new Solution())->permute([1,2,3]));
