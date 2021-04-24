<?php

class Solution {

    /**
     * @param String $s
     * @return String[]
     */
    function restoreIpAddresses($s) {
        $sLen = strlen($s);
        if ($sLen === 0) {
            return [];
        }
        for ($i = 0; $i < $sLen; ++$i) {
            if (!ctype_digit($s[$i])) {
                return [];
            }
        }

        $restoreIpAddressesFunc = null;
        $restoreIpAddressesFunc = function ($s, $count = 1) use (&$restoreIpAddressesFunc) {
            if ($count > 5) {
                return [];
            }

            $strLen = strlen($s);
            if ($strLen === 0) {
                return [];
            }

            $ipAddressList = [];

            if ($strLen >= 3) {
                $maxLen = 3;
            } else {
                $maxLen = $strLen;
            }
            if ($s[0] === '0') {
                $maxLen = 1;
            }

            $part = [];
            for ($i = 0; $i < $maxLen; ++$i) {
                array_unshift($part, intval($s[$i]));

                $number = 0;
                foreach ($part as $j => $digit) {
                    $number += ($digit * pow(10, $j));
                }
                if ($number < 256) {
                    $ipAddress = [$number];
                    $subIpAddressList = $restoreIpAddressesFunc(
                        substr($s, $i + 1),
                        $count + 1
                    );
                    $hasSubIpAddressList = false;
                    foreach ($subIpAddressList as $subIpAddress) {
                        $hasSubIpAddressList = true;
                        $ipAddressList[] = array_merge($ipAddress, $subIpAddress);
                    }
                    if (!$hasSubIpAddressList) {
                        $ipAddressList[] = $ipAddress;
                    }
                }
            }

            return $ipAddressList;
        };

        $ipAddressList = $restoreIpAddressesFunc($s);

        $result = [];
        foreach ($ipAddressList as $ipAddress) {
            if (count($ipAddress) === 4) {
                $ipAddressStr = implode('.', $ipAddress);
                if (strlen($ipAddressStr) === ($sLen + 3)) {
                    $result[] = $ipAddressStr;
                }
            }
        }
        return $result;
    }
}

var_dump(
    (new Solution())->restoreIpAddresses('101023')
);
