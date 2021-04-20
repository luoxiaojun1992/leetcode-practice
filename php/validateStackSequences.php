<?php

class Solution {

    /**
     * @param Integer[] $pushed
     * @param Integer[] $popped
     * @return Boolean
     */
    function validateStackSequences($pushed, $popped) {
        $stack = [];
        $stackSize = 0;
        foreach ($pushed as $val) {
            array_push($stack, $val);
            ++$stackSize;
            while (true) {
                $toPoppedVal = array_shift($popped);
                if (is_null($toPoppedVal)) {
                    break;
                }
                $poppedVal = array_pop($stack);
                if (is_null($poppedVal)) {
                    array_unshift($popped, $toPoppedVal);
                    break;
                }
                --$stackSize;
                if ($toPoppedVal !== $poppedVal) {
                    array_unshift($popped, $toPoppedVal);
                    array_push($stack, $poppedVal);
                    ++$stackSize;
                    break;
                }
            }
        }

        return $stackSize === 0;
    }
}

var_dump(
    (new Solution())->validateStackSequences([1,3,2,0], [1,2,0,3])
);
