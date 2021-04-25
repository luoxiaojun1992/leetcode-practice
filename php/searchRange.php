<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function searchRange($nums, $target) {
        $start = 0;
        $numsCount = count($nums);
        $end = $numsCount - 1;
        if ($start === $end) {
            $median = $start;
        } else {
            $median = intval(floor(($end + $start) / 2));
        }
        $foundIndex = null;
        $minFoundIndex = null;
        $maxFoundIndex = null;

        $findFunc = null;
        $findFunc = function ($start, $end, $median) use (
            &$findFunc, $nums, $target, &$foundIndex, &$minFoundIndex, &$maxFoundIndex, $numsCount
        ) {
            while ($start <= $end) {
                $mediumVal = $nums[$median];
                if ($target < $mediumVal) {
                    $end = $median - 1;
                    if ($start === $end) {
                        $median = $start;
                    } else {
                        $median = intval(floor(($end + $start) / 2));
                    }
                } elseif ($target > $mediumVal) {
                    $start = $median + 1;
                    if ($start === $end) {
                        $median = $start;
                    } else {
                        $median = intval(floor(($end + $start) / 2));
                    }
                } else {
                    $foundIndex = $median;
                    if (is_null($minFoundIndex)) {
                        $minFoundIndex = $foundIndex;
                    } else {
                        if ($foundIndex < $minFoundIndex) {
                            $minFoundIndex = $foundIndex;
                        }
                    }
                    if (is_null($maxFoundIndex)) {
                        $maxFoundIndex = $foundIndex;
                    } else {
                        if ($foundIndex > $maxFoundIndex) {
                            $maxFoundIndex = $foundIndex;
                        }
                    }

                    $newStart = $start;
                    $newEnd = $median - 1;
                    if ($newStart === $newEnd) {
                        $newMedian = $newStart;
                    } else {
                        $newMedian = intval(floor(($newEnd + $newStart) / 2));
                    }
                    $findFunc($newStart, $newEnd, $newMedian);

                    $newStart = $median + 1;
                    $newEnd = $end;
                    if ($newStart === $newEnd) {
                        $newMedian = $newStart;
                    } else {
                        $newMedian = intval(floor(($newEnd + $newStart) / 2));
                    }
                    $findFunc($newStart, $newEnd, $newMedian);

                    break;
                }
            }
        };

        $findFunc($start, $end, $median);

        return [
            (!is_null($minFoundIndex)) ? $minFoundIndex : -1,
            (!is_null($maxFoundIndex)) ? $maxFoundIndex : -1,
        ];
    }
}

var_dump(
    (new Solution())->searchRange([], 0)
);
