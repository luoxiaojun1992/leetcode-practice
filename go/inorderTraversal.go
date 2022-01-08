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
 func inorderTraversal(root *TreeNode) []int {
    var result []int
    var stack [] *TreeNode

    for ;; {
        if root == nil {
            stackLen := len(stack)
            if stackLen > 0 {
                root = stack[stackLen - 1]
                stack = stack[:stackLen - 1]
            }
        }

        if root != nil {
            if root.Left != nil {
				stack = append(stack, root)
				leftNode := root.Left
				root.Left = nil
                root = leftNode
            } else {
				result = append(result, root.Val)
				rightNode := root.Right
				root = nil
				if rightNode != nil {
					root = rightNode
				}
			}
        } else {
            break
        }
    }

    return result
}
