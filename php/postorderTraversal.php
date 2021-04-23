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
     * @return Integer[]
     */
    function postorderTraversal($root) {
        $orders = [];
        if (is_null($root)) {
            return $orders;
        }

        if (!is_null($root->left)) {
            $orders = array_merge($orders, $this->postorderTraversal($root->left));
        }
        if (!is_null($root->right)) {
            $orders = array_merge($orders, $this->postorderTraversal($root->right));
        }
        $orders[] = $root->val;
        return $orders;
    }
}

var_dump(
    (new Solution())->postorderTraversal(
        (new TreeNode(
            1,
            null,
            (new TreeNode(
                2,
                (new TreeNode(3))
            ))
        ))
    )
);
