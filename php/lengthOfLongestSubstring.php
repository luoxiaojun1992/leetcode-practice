class Solution {

    /**
     * @param String $s
     * @return Integer
     */
    function lengthOfLongestSubstring($s) {
        $len = 0;
        $currentLen = 0;
        $charArr = [];

        $sLen = strlen($s);
        for($i = 0; $i < $sLen; ++$i) {
            $char = $s[$i];
            
            if (in_array($char, $charArr)) {
                if ($currentLen > $len) {
                    $len = $currentLen;
                }
                
                $charPos = array_search($char, $charArr);
                $currentLen = $currentLen - $charPos;
                $charArr = array_slice($charArr, $charPos + 1);
                $charArr[] = $char;
            } else {
                ++$currentLen;
                $charArr[] = $char;
            }
        }

        if ($currentLen > $len) {
            $len = $currentLen;
        }
        
        return $len;
    }
}
