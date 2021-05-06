<?php

class Solution {
    /**
     * @param String $s
     * @return Integer
     */
    function numDecodings($s) {
        $states = [];
        $sLen = strlen($s);
        if ($sLen <= 0) {
            return 0;
        }
        if ($s[0] === '0') {
            return 0;
        }

        $states[0] = 1;

        for ($i = 1; $i <= $sLen; ++$i) {
            if ($s[$i - 1] !== '0') {
                $states[$i] = $states[$i - 1];
            }
            if ($i > 1) {
                if ($s[$i - 2] !== '0') {
                    $intCode = intval(($s[$i - 2]) . ($s[$i - 1]));
                    if (($intCode > 0) && ($intCode <= 26)) {
                        if (isset($states[$i])) {
                            $states[$i] = $states[$i] + $states[$i - 2];
                        } else {
                            $states[$i] = $states[$i - 2];
                        }
                    }
                }
            }
            if (!isset($states[$i])) {
                $states[$i] = 0;
                break;
            }
        }

        return isset($states[$sLen]) ? $states[$sLen] : 0;
    }
}

var_dump(
    (new Solution())->numDecodings("111111111111111111111111111111111111111111111")
);
