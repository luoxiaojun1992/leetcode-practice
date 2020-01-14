class Solution {

    /**
     * @param Integer[] $nums1
     * @param Integer[] $nums2
     * @return Float
     */
    function findMedianSortedArrays($nums1, $nums2) {
        $mergeNums = [];
        $numCount = 0;

        for($i = 0, $j = 0; true;) {
            $num1 = isset($nums1[$i]) ? $nums1[$i] : null;
            $num2 = isset($nums2[$j]) ? $nums2[$j] : null;
            if (is_null($num1) && is_null($num2)) {
                break;
            }
            if (is_null($num1)) {
                $mergeNums[] = $num2;
                ++$j;
                ++$numCount;
                continue;
            }
            if (is_null($num2)) {
                $mergeNums[] = $num1;
                ++$i;
                ++$numCount;
                continue;
            }

            if ($num1 < $num2) {
                $mergeNums[] = $num1;
                ++$numCount;
                ++$i;
            } else {
                $mergeNums[] = $num2;
                ++$numCount;
                ++$j;
            }
        }

        $result = 0;
        
        if ($numCount <= 0) {
            $result = 0;
        } else {
            if ($numCount % 2 == 0) {
                $result = ($mergeNums[$numCount / 2 - 1] + $mergeNums[$numCount / 2]) / 2;
            } else {
                $result = $mergeNums[floor($numCount / 2)];
            }
        }
        
        return sprintf('%.5f', $result);
    }
}
