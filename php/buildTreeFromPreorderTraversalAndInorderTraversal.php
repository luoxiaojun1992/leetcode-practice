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
     * @param Integer[] $preorder
     * @param Integer[] $inorder
     * @return TreeNode
     */
    function buildTree($preorder, $inorder) {
        $rootVal = array_shift($preorder);

        if (is_null($rootVal)) {
            return null;
        }

        $rootInorderIndex = 0;
        foreach ($inorder as $i => $val) {
            if ($val === $rootVal) {
                $rootInorderIndex = $i;
                break;
            }
        }

        $leftInorder = array_slice($inorder, 0, $rootInorderIndex);
        $rightInorder = array_slice($inorder, $rootInorderIndex + 1);
        $leftInorderMap = [];
        foreach ($leftInorder as $val) {
            $leftInorderMap[$val] = true;
        }

        $leftPreorder = [];
        $rightPreorder = [];

        foreach ($preorder as $val) {
            if (isset($leftInorderMap[$val])) {
                $leftPreorder[] = $val;
            } else {
                $rightPreorder[] = $val;
            }
        }

        return (new TreeNode(
            $rootVal,
            $this->buildTree($leftPreorder, $leftInorder),
            $this->buildTree($rightPreorder, $rightInorder)
        ));
    }
}

var_dump(
    (new Solution())->buildTree(
        [3,9,20,15,7],
        [9,3,15,20,7]
    )
);
