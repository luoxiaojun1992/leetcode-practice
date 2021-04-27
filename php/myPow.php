<?php

class Solution {

    /**
     * @param Float $x
     * @param Integer $n
     * @return Float
     */
    function myPow($x, $n)
    {
        if ($n < 0) {
            $realN = (-1 * $n);
        } else {
            $realN = $n;
        }

        if ($realN <= 0) {
            $result = 1;
        } else {
            $n1 = intval(floor($realN / 2));
            $result = $this->myPow($x, $n1);
            $result = $result * $result;
            if (($realN % 2) !== 0) {
                $result = $result * $x;
            }
        }

        if ($n < 0) {
            $result = 1 / $result;
        }

        return $result;
    }
}

var_dump(
    (new Solution())->myPow(2.00000, 10)
);
