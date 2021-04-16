<?php

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($val = 0, $left = null, $right = null) {
 *         $this->val = $val;
 *         $this->left = $left;
 *         $this->right = $right;
 *     }
 * }
 */

class TreeNode
{
    public $val = null;
    public $left = null;
    public $right = null;

    function __construct($val = 0, $left = null, $right = null)
    {
        $this->val = $val;
        $this->left = $left;
        $this->right = $right;
    }
}

class Solution {

    /**
     * @param TreeNode $root
     * @return Integer[][]
     */
    function levelOrder($root) {
        $result = [];

        if (is_null($root)) {
            return $result;
        }

        $currentNodes = [$root];

        do {
            $newCurrentNodes = [];
            $subResult = [];
            foreach ($currentNodes as $node) {
                $subResult[] = $node->val;
                if (!is_null($node->left)) {
                    $newCurrentNodes[] = $node->left;
                }
                if (!is_null($node->right)) {
                    $newCurrentNodes[] = $node->right;
                }
            }
            $result[] = $subResult;
            $currentNodes = $newCurrentNodes;
        } while (count($currentNodes) > 0);

        return $result;
    }
}

var_dump(
    (new Solution())->levelOrder(
        (new TreeNode(
            3,
            (new TreeNode(9, null, null)),
            (new TreeNode(
                20,
                (new TreeNode(
                    15, null, null
                )),
                (new TreeNode(
                    7, null, null
                ))
            ))
        ))
    )
);
