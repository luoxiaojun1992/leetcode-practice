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
 func postorderTraversal(root *TreeNode) []int {
    var result []int
    var stack [] *TreeNode

    for ;; {
        if root == nil {
            stackSize := len(stack)
            if stackSize > 0 {
                root = stack[stackSize - 1]
                stack = stack[:stackSize - 1]
            }
        }

        if root == nil {
            break
        }

        if root.Left != nil {
            leftNode := root.Left
            root.Left = nil
            stack = append(stack, root)
            root = leftNode
        } else if root.Right != nil {
            rightNode := root.Right
            root.Right = nil
            stack = append(stack, root)
            root = rightNode
        } else {
            result = append(result, root.Val)
            root = nil
        }
    }

    return result
}
