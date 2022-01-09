package main

type TreeNode struct {
	Val int
	Left *TreeNode
	Right *TreeNode
}

/**
 * Definition for a binary tree node.
 * type TreeNode struct {
 *     Val int
 *     Left *TreeNode
 *     Right *TreeNode
 * }
 */
 func preorderTraversal(root *TreeNode) []int {
    var result []int
    var stack [] *TreeNode

    for ;; {
        if root == nil {
            stackSize := len(stack)
            if (stackSize > 0) {
                root = stack[stackSize - 1]
                stack = stack[:stackSize - 1]
            }
        }

        if root != nil {
            result = append(result, root.Val)
            if root.Left != nil {
                if root.Right != nil {
                    stack = append(stack, root.Right)
                }
                root = root.Left
            } else if root.Right != nil {
                root = root.Right
            } else {
                root = nil
            }
        } else {
            break
        }
    }

    return result
}
