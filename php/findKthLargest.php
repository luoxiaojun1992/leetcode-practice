<?php

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function findKthLargest($nums, $k)
    {
        $start = 0;
        $end = count($nums) - 1;
        $pivot = $end;

        do {
            $i = $start;
            for ($j = $start; $j < $pivot; ++$j) {
                if ($nums[$j] <= $nums[$pivot]) {
                    $temp = $nums[$i];
                    $nums[$i] = $nums[$j];
                    $nums[$j] = $temp;
                    ++$i;
                }
            }

            $temp = $nums[$i];
            $nums[$i] = $nums[$pivot];
            $nums[$pivot] = $temp;

            $topCount = $end - $i + 1;
            if ($topCount < $k) {
                $k = $k - $topCount;
                $end = $i - 1;
                $pivot = $end;
            } elseif ($topCount > $k) {
                $start = $i + 1;
            } else {
                break;
            }
        } while (true);

        return $nums[$i];
    }
}

var_dump((new Solution())->findKthLargest(
    [3,2,3,1,2,4,5,5,6], 4
));
