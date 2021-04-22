<?php

class Solution {

    /**
     * @param Integer $num
     * @return String
     */
    function intToRoman($num) {
        $tenCount = ($num - ($num % 10)) / 10;
        $hundredCount = ($num - ($num % 100)) / 100;
        $thousandCount = ($num - ($num % 1000)) / 1000;
        $singleNum = $num % 10;

        $hundredCount -= ($thousandCount * 10);

        $tenCount -= ($hundredCount * 10);
        $tenCount -= ($thousandCount * 100);

        $roman = '';
        if ($thousandCount > 0) {
            $roman .= str_repeat('M', $thousandCount);
        }
        if ($hundredCount > 0) {
            if ($hundredCount === 4) {
                $roman .= 'CD';
            } elseif ($hundredCount === 9) {
                $roman .= 'CM';
            } elseif ($hundredCount === 5) {
                $roman .= 'D';
            } else {
                if ($hundredCount >= 5) {
                    $roman .= ('D' . str_repeat('C', $hundredCount - 5));
                } else {
                    $roman .= str_repeat('C', $hundredCount);
                }
            }
        }
        if ($tenCount > 0) {
            if ($tenCount === 4) {
                $roman .= 'XL';
            } elseif ($tenCount === 9) {
                $roman .= 'XC';
            } else {
                if ($tenCount >= 5) {
                    $roman .= ('L' . str_repeat('X', $tenCount - 5));
                } else {
                    $roman .= str_repeat('X', $tenCount);
                }
            }
        }
        if ($singleNum <= 3) {
            $roman .= str_repeat('I', $singleNum);
        } else {
            if ($singleNum == 4) {
                $roman .= 'IV';
            } elseif ($singleNum == 9) {
                $roman .= 'IX';
            } else {
                $roman .= ('V' . str_repeat('I', $singleNum - 5));
            }
        }

        return $roman;
    }
}

var_dump(
    (new Solution())->intToRoman(1994)
);
