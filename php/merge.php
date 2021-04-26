<?php

class Solution {

    /**
     * @param Integer[][] $intervals
     * @return Integer[][]
     */
    function merge($intervals) {
        $flatIntervals = [];
        foreach ($intervals as $interval) {
            $flatIntervals[] = $interval[0];
            $flatIntervals[] = $interval[1];
        }

        asort($flatIntervals);

        $multiFlatIntervals = [];
        $tempFlatIntervals = [];
        $tempFlatIntervalsCnt = 0;
        $currentNumber = null;
        foreach ($flatIntervals as $i => $number) {
            if ($tempFlatIntervalsCnt <= 0) {
                $currentNumber = $number;
                $tempFlatIntervals[$i] = $number;
                ++$tempFlatIntervalsCnt;
            } else {
                if ($currentNumber === $number) {
                    $tempFlatIntervals[$i] = $number;
                    ++$tempFlatIntervalsCnt;
                } else {
                    $multiFlatIntervals[] = $tempFlatIntervals;
                    $tempFlatIntervals = [];
                    $tempFlatIntervalsCnt = 1;
                    $currentNumber = $number;
                    $tempFlatIntervals[$i] = $number;
                }
            }
        }
        if ($tempFlatIntervalsCnt > 0) {
            $multiFlatIntervals[] = $tempFlatIntervals;
        }
        $flatIntervals = [];
        foreach ($multiFlatIntervals as $tempFlatIntervals) {
            ksort($tempFlatIntervals);
            $flatIntervals = $flatIntervals + $tempFlatIntervals;
        }

        $stack = [];
        $mergedIntervals = [];

        foreach ($flatIntervals as $i => $number) {
            if (($i % 2) == 0) {
                array_push($stack, $number);
            } else {
                $rangeStart = array_pop($stack);
                $nextNumber = array_pop($stack);
                if (!is_null($nextNumber)) {
                    array_push($stack, $nextNumber);
                } else {
                    $mergedIntervals[] = [$rangeStart, $number];
                }
            }
        }

        foreach ($mergedIntervals as $i => $mergedInterval) {
            if (isset($mergedIntervals[$i - 1])) {
                $prevMergedInterval = $mergedIntervals[$i - 1];
                if ($prevMergedInterval[1] === $mergedInterval[0]) {
                    unset($mergedIntervals[$i - 1]);
                    unset($mergedIntervals[$i]);
                    $mergedIntervals[$i] = [$prevMergedInterval[0], $mergedInterval[1]];
                }
            }
        }

        return array_values($mergedIntervals);
    }
}

var_dump(
    (new Solution())->merge([[5,5],[1,3],[3,5],[4,6],[1,1],[3,3],[5,6],[3,3],[2,4],[0,0]])
);
