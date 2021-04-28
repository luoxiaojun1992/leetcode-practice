<?php

class Solution {

    /**
     * @param Integer[] $gas
     * @param Integer[] $cost
     * @return Integer
     */
    function canCompleteCircuit($gas, $cost) {
        $gasStationCount = count($gas);
        $startMap = [true];
        $start = 0;
        $started = false;
        $remaining = 0;
        for ($i = $start; true; $i < $gasStationCount - 1 ? ++$i : $i = 0) {
            if ($i === $start) {
                if (!$started) {
                    $started = true;
                    $remaining = $gas[$i];
                } else {
                    $prevGasStation = $i - 1;
                    if ($prevGasStation < 0) {
                        $prevGasStation = $gasStationCount - 1;
                    }
                    $remaining = $remaining - $cost[$prevGasStation];
                    break;
                }
            } else {
                $prevGasStation = $i - 1;
                if ($prevGasStation < 0) {
                    $prevGasStation = $gasStationCount - 1;
                }
                $estRemaining = $remaining - $cost[$prevGasStation];
                if ($estRemaining >= 0) {
                    $remaining = $estRemaining + $gas[$i];
                } else {
                    $start = $i;
                    $started = true;
                    $remaining = $gas[$i];
                    if (isset($startMap[$start])) {
                        $remaining = $estRemaining;
                        break;
                    }
                    $startMap[$start] = true;
                }
            }
        }

        if ($remaining >= 0) {
            return $start;
        } else {
            return -1;
        }
    }
}

var_dump(
    (new Solution())->canCompleteCircuit(
        [1,2,3,4,3,2,4,1,5,3,2,4],
        [1,1,1,3,2,4,3,6,7,4,3,1]
    )
);
