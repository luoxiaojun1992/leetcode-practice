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
     * @param Integer[] $inorder
     * @param Integer[] $postorder
     * @return TreeNode
     */
    function buildTree($inorder, $postorder) {
        $rootVal = array_pop($postorder);

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

        $leftPostorder = [];
        $rightPostorder = [];

        foreach ($postorder as $val) {
            if (isset($leftInorderMap[$val])) {
                $leftPostorder[] = $val;
            } else {
                $rightPostorder[] = $val;
            }
        }

        return (new TreeNode(
            $rootVal,
            $this->buildTree($leftInorder, $leftPostorder),
            $this->buildTree($rightInorder, $rightPostorder)
        ));
    }
}

var_dump(
    (new Solution())->buildTree(
        [9,3,15,20,7],
        [9,15,7,20,3]
    )
);
