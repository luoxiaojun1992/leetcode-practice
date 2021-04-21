<?php

class Solution {

    /**
     * @param String $str
     * @return Integer
     */
    function myAtoi($str) {
        $strLen = strlen($str);

        $validChars = [' ', '-', '+', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $digits = [];
        $sign = null;

        for ($i = 0; $i < $strLen; ++$i) {
            if (!in_array($str[$i], $validChars, true)) {
                break;
            } else {
                switch ($str[$i]) {
                    case ' ':
                        if (!is_null($sign)) {
                            break 2;
                        }
                        $lastDigit = array_pop($digits);
                        if (!is_null($lastDigit)) {
                            array_push($digits, $lastDigit);
                            break 2;
                        }
                        break;
                    case '-':
                    case '+':
                        $lastDigit = array_pop($digits);
                        if (!is_null($lastDigit)) {
                            array_push($digits, $lastDigit);
                            break 2;
                        }
                        if (!is_null($sign)) {
                            break 2;
                        }
                        $sign = (($str[$i] === '+') ? 1 : -1);
                        break;
                    case '0':
                        array_unshift($digits, 0);
                        break;
                    case '1':
                        array_unshift($digits, 1);
                        break;
                    case '2':
                        array_unshift($digits, 2);
                        break;
                    case '3':
                        array_unshift($digits, 3);
                        break;
                    case '4':
                        array_unshift($digits, 4);
                        break;
                    case '5':
                        array_unshift($digits, 5);
                        break;
                    case '6':
                        array_unshift($digits, 6);
                        break;
                    case '7':
                        array_unshift($digits, 7);
                        break;
                    case '8':
                        array_unshift($digits, 8);
                        break;
                    case '9':
                        array_unshift($digits, 9);
                        break;
                }
            }
        }

        $lastDigit = array_pop($digits);
        if (is_null($lastDigit)) {
            return 0;
        } else {
            array_push($digits, $lastDigit);
        }

        $result = 0;
        foreach ($digits as $i => $digit) {
            $result += ($digit * pow(10, $i));
        }



        $result = (is_null($sign) ? 1 : $sign) * $result;

        $lowBound = (-1 * pow(2, 31));
        $upperBound = (pow(2, 31) - 1);
        if ($result < $lowBound) {
            $result = $lowBound;
        } elseif ($result > $upperBound) {
            $result = $upperBound;
        }

        return $result;
    }
}

var_dump(
    (new Solution())->myAtoi('9223372036854775808')
);
