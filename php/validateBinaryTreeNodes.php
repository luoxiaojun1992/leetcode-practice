<?php

class Solution {

    /**
     * @param Integer $n
     * @param Integer[] $leftChild
     * @param Integer[] $rightChild
     * @return Boolean
     */
    function validateBinaryTreeNodes($n, $leftChild, $rightChild) {
        $subNodes = [];
        for ($i = 0; $i < $n; ++$i) {
            $leftChildNode = $leftChild[$i];
            if ($leftChildNode !== -1) {
                if (isset($subNodes[$leftChildNode])) {
                    return false;
                }
                $subNodes[$leftChildNode] = true;
                if ($leftChild[$leftChildNode] === $i) {
                    return false;
                }
                if ($rightChild[$leftChildNode] === $i) {
                    return false;
                }
            }

            $rightChildNode = $rightChild[$i];
            if ($rightChildNode !== -1) {
                if (isset($subNodes[$rightChildNode])) {
                    return false;
                }
                $subNodes[$rightChildNode] = true;
                if ($leftChild[$rightChildNode] === $i) {
                    return false;
                }
                if ($rightChild[$rightChildNode] === $i) {
                    return false;
                }
            }
        }

        $count = 0;
        for ($i = 0; $i < $n; ++$i) {
            if (!isset($subNodes[$i])) {
                ++$count;
                if ($count > 1) {
                    return false;
                }
                if (($leftChild[$i] === -1) && ($rightChild[$i] === -1)) {
                    if ($n > 1) {
                        return false;
                    }
                }
            }
        }
        if ($count === 0) {
            return false;
        }

        return true;
    }
}

var_dump(
    (new Solution())->validateBinaryTreeNodes(4, [1,2,0,-1], [-1,-1,-1,-1])
);
