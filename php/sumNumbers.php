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
    function sumNumbers($root) {
        if (is_null($root)) {
            return 0;
        }

        $collectNumbersFunc = null;
        $collectNumbersFunc = function ($root) use (&$collectNumbersFunc) {
            $numbers = [];

            if (is_null($root->left) && is_null($root->right)) {
                $number = [];
                $number[] = $root->val;
                $numbers[] = $number;
            } else {
                if (!is_null($root->left)) {
                    $leftNumbers = $collectNumbersFunc($root->left);
                    foreach ($leftNumbers as $leftNumber) {
                        $leftNumber[] = $root->val;
                        $numbers[] = $leftNumber;
                    }
                }
                if (!is_null($root->right)) {
                    $rightNumbers = $collectNumbersFunc($root->right);
                    foreach ($rightNumbers as $rightNumber) {
                        $rightNumber[] = $root->val;
                        $numbers[] = $rightNumber;
                    }
                }
            }

            return $numbers;
        };

        $total = 0;

        $numbers = $collectNumbersFunc($root);

        foreach ($numbers as $number) {
            foreach ($number as $i => $digit) {
                $total += ($digit * pow(10, $i));
            }
        }

        return intval($total);
    }
}

var_dump(
    (new Solution())->sumNumbers(
        (new TreeNode(
            4,
            (new TreeNode(
                9,
                (new TreeNode(5)),
                (new TreeNode(1))
            )),
            (new TreeNode(0))
        ))
    )
);
