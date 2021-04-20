<?php

class Solution {

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse($x) {
        $result = 0;

        $arr = [];
        $positive = $x > 0;
        if ($x < 0) {
            $x = -1 * $x;
        }

        $bitCount = 0;
        for ($i = 0; true; ++$i) {
            $newNum = intval($x / pow(10, $i));
            if ($newNum < 1) {
                break;
            }

            $bit = $newNum % 10;
            if (count($arr) == 0) {
                if ($bit == 0) {
                    continue;
                } else {
                    ++$bitCount;
                    $arr[] = $bit;
                }
            } else {
                ++$bitCount;
                $arr[] = $bit;
            }
        }

        foreach($arr as $bit) {
            $result += ($bit * pow(10, $bitCount - 1));
            --$bitCount;
        }

        if (!$positive) {
            $result = (-1 * $result);
        }

        if (($result < (-1 * pow(2, 31))) || ($result > (pow(2, 31) - 1))) {
            return 0;
        }

        return $result;
    }
}
