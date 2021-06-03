<?php

class Solution {

    /**
     * @param String $s
     * @return String[]
     */
    function findRepeatedDnaSequences($s) {
        $result = [];
        $sLen = strlen($s);
        $hashMap = [];
        $found = [];
        for ($i = 0; $i < $sLen; ++$i) {
            $subStr = '';
            if ($i + 9 >= $sLen) {
                break;
            }
            for ($j = 0; $j < 10; ++$j) {
                $subStr .= $s[$i + $j];
            }
            $hash = md5($subStr);
            $hasFound = false;
            if (isset($found[$hash])) {
                foreach ($found[$hash] as $tplStr) {
                    if ($tplStr === $subStr) {
                        $hasFound = true;
                        break;
                    }
                }
            }
            if (!$hasFound) {
                $existed = false;
                if (isset($hashMap[$hash])) {
                    foreach ($hashMap[$hash] as $tplStr) {
                        if ($tplStr === $subStr) {
                            $result[] = $subStr;
                            $found[$hash][] = $subStr;
                            $existed = true;
                            break;
                        }
                    }
                }
                if (!$existed) {
                    $hashMap[$hash][] = $subStr;
                }
            }
        }
        return $result;
    }
}

var_dump(
    (new Solution())->findRepeatedDnaSequences('AAAAAAAAAAAAA')
);
