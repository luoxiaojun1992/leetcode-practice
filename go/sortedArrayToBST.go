package main

import(
	"fmt"
)

type TreeNode struct {
	Val int
    Left *TreeNode
	Right *TreeNode
}

func main() {
	rootNode := sortedArrayToBST([]int{-10, -3, 0, 5, 9})
	fmt.Println(rootNode.Val)
}

/**
 * Definition for a binary tree node.
 * type TreeNode struct {
 *     Val int
 *     Left *TreeNode
 *     Right *TreeNode
 * }
 */
func sortedArrayToBST(nums []int) *TreeNode {
	numsCount := len(nums)
	if numsCount == 0 {
		return nil
	}

	if numsCount == 1 {
		return &TreeNode{
			Val: nums[0],
			Left: nil,
			Right: nil,
		}
	}

	rootIndex := numsCount / 2
	if numsCount % 2 != 0 {
		rootIndex++
	}

	var subLeftTree *TreeNode
	if rootIndex - 1 > 0 && rootIndex - 1 < numsCount {
		subLeftTree = sortedArrayToBST(nums[:rootIndex - 1])
	}
	var subRightTree *TreeNode
	if rootIndex >= 0 && rootIndex < numsCount {
		subRightTree = sortedArrayToBST(nums[rootIndex:])
	}

	rootNode := &TreeNode{
		Val: nums[rootIndex - 1],
		Left: subLeftTree,
		Right: subRightTree,
	}

	return rootNode
}
