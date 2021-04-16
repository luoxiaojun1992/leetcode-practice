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
     * @return Integer[]
     */
    function inorderTraversal($root) {
        $result = [];

        if (is_null($root)) {
            return $result;
        }

        if (!is_null($root->left)) {
            $result = array_merge($result, $this->inorderTraversal($root->left));
        }
        $result[] = $root->val;
        if (!is_null($root->right)) {
            $result = array_merge($result, $this->inorderTraversal($root->right));
        }
        return $result;
    }
}

var_dump(
    (new Solution())->inorderTraversal(
        (new TreeNode(
            1,
            null,
            (new TreeNode(
                2,
                (new TreeNode(
                    3, null, null
                )),
                null
            ))
        ))
    )
);
