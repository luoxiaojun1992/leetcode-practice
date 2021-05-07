<?php

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
class Solution {

    /**
     * @param TreeNode $root
     * @return Integer
     */
    function countNodes($root) {
        $nodeCount = 0;

        $scanFunc = null;
        $scanFunc = function ($root) use (&$nodeCount, &$scanFunc) {
            if (is_null($root)) {
                return;
            }

            ++$nodeCount;

            $scanFunc($root->left);
            $scanFunc($root->right);
        };

        $scanFunc($root);

        return $nodeCount;
    }
}

var_dump(
    (new Solution())->countNodes(
        (new TreeNode(
            1,
            (new TreeNode(
                2,
                (new TreeNode(4)),
                (new TreeNode(5))
            )),
            (new TreeNode(
                3,
                (new TreeNode(6))
            ))
        ))
    )
);
