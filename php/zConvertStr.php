class Solution {

    /**
     * @param String $s
     * @param Integer $numRows
     * @return String
     */
    function convert($s, $numRows) {
        if ($numRows <= 1) {
            return $s;
        }

        $sLen = strlen($s);
        $arr = [];

        for ($i = 0; $i < $sLen; ++$i) {
            if ($i % (2 * $numRows - 2) < $numRows) {
                $arr[$i % (2 * $numRows - 2)] .= $s[$i];
            } else {
                $arr[$numRows - ($i % (2 * $numRows - 2) + 1 - $numRows) - 1] .= $s[$i];
            }
        }

        return implode('', $arr);
    }
}
