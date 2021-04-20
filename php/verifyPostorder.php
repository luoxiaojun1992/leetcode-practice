<?php

class Solution {

    /**
     * @param Integer[] $postorder
     * @return Boolean
     */
    function verifyPostorder($postorder)
    {
        if (empty($postorder)) {
            return true;
        }

        $root = array_pop($postorder);
        $rightSubTree = [];
        $leftSubTree = [];
        $hasLeftTree = false;

        while (!is_null($node = array_pop($postorder))) {
            if ($node > $root) {
                if ($hasLeftTree) {
                    return false;
                }

                array_unshift($rightSubTree, $node);
            } else {
                $hasLeftTree = true;
                array_unshift($leftSubTree, $node);
            }
        }

        return $this->verifyPostorder($leftSubTree) && $this->verifyPostorder($rightSubTree);
    }
}

var_dump(
    (new Solution())->verifyPostorder([4, 8, 6, 12, 16, 14, 10])
);
