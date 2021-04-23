<?php

class Solution {

    /**
     * @param Integer $n
     * @param Integer[] $leftChild
     * @param Integer[] $rightChild
     * @return Boolean
     */
    function validateBinaryTreeNodes($n, $leftChild, $rightChild) {
        $inDeg = [];

        for ($i = 0; $i < $n; ++$i) {
            if ($leftChild[$i] !== -1) {
                $nodeId = $leftChild[$i];
                if (isset($inDeg[$nodeId])) {
                    $inDeg[$nodeId] += 1;
                } else {
                    $inDeg[$nodeId] = 1;
                }
            }

            if ($rightChild[$i] !== -1) {
                $nodeId = $rightChild[$i];
                if (isset($inDeg[$nodeId])) {
                    $inDeg[$nodeId] += 1;
                } else {
                    $inDeg[$nodeId] = 1;
                }
            }
        }

        $root = null;
        $zeroDegCount = 0;
        for ($i = 0; $i < $n; ++$i) {
            if (isset($inDeg[$i])) {
                if ($inDeg[$i] === 0) {
                    ++$zeroDegCount;
                    if ($zeroDegCount > 1) {
                        return false;
                    }
                    $root = $i;
                }
            } else {
                ++$zeroDegCount;
                if ($zeroDegCount > 1) {
                    return false;
                }
                $root = $i;
            }
        }
        if (is_null($root)) {
            return false;
        }

        $scanned = [];
        $nodeCount = 0;
        $scanNodeFunc = null;
        $scanNodeFunc = function ($root) use ($leftChild, $rightChild, &$nodeCount, &$scanNodeFunc, &$scanned) {
            if ($root === -1) {
                return;
            }

            ++$nodeCount;
            if (isset($scanned[$root])) {
                return;
            }
            $scanned[$root] = true;

            if ($leftChild[$root] !== -1) {
                $scanNodeFunc($leftChild[$root]);
            }
            if ($rightChild[$root] !== -1) {
                $scanNodeFunc($rightChild[$root]);
            }
        };
        $scanNodeFunc($root);

        return $nodeCount === $n;
    }
}

var_dump(
    (new Solution())->validateBinaryTreeNodes(4, [1,-1,3,-1], [2,3,-1,-1])
);
