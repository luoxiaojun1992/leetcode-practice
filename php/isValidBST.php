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
     * @return Boolean
     */
    function isValidBST($root) {
        $isValidBSTFunc = null;
        $isValidBSTFunc = function ($root, $min = null, $max = null) use (&$isValidBSTFunc) {
            $result = true;
            if (!is_null($root->left)) {
                if ($root->left->val >= $root->val) {
                    $result = false;
                } elseif ((!is_null($min)) && ($root->left->val <= $min)) {
                    $result = false;
                } elseif ((!is_null($max)) && ($root->left->val >= $max)) {
                    $result = false;
                } else {
                    if (!$isValidBSTFunc($root->left, $min, (!is_null($max)) ? min($max, $root->val) : $root->val)) {
                        $result = false;
                    }
                }
            }
            if (!is_null($root->right)) {
                if ($root->right->val <= $root->val) {
                    $result = false;
                }  elseif ((!is_null($min)) && ($root->right->val <= $min)) {
                    $result = false;
                } elseif ((!is_null($max)) && ($root->right->val >= $max)) {
                    $result = false;
                } else {
                    if (!$isValidBSTFunc($root->right, (!is_null($min)) ? max($min, $root->val) : $root->val, $max)) {
                        $result = false;
                    }
                }
            }
            return $result;
        };

        return $isValidBSTFunc($root);
    }
}

var_dump(
    (new Solution())->isValidBST(
        (new TreeNode(
            5,
            (new TreeNode(
                4
            )),
            (new TreeNode(
                6,
                (new TreeNode(3)),
                (new TreeNode(7))
            ))
        ))
    )
);
