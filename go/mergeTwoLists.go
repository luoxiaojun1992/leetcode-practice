package main

type ListNode struct {
	Val  int
	Next *ListNode
}

/**
 * Definition for singly-linked list.
 * type ListNode struct {
 *     Val int
 *     Next *ListNode
 * }
 */
func mergeTwoLists(list1 *ListNode, list2 *ListNode) *ListNode {
	var headNode *ListNode
	var mergedList *ListNode

	for {
		if list1 == nil && list2 == nil {
			break
		}

		if list2 == nil || (list1 != nil && list1.Val <= list2.Val) {
			if mergedList == nil {
				headNode = &ListNode{}
				mergedList = headNode
				mergedList.Val = list1.Val
			} else {
				mergedList.Next = &ListNode{}
				mergedList.Next.Val = list1.Val
				mergedList = mergedList.Next
			}
			list1 = list1.Next
		} else {
			if mergedList == nil {
				headNode = &ListNode{}
				mergedList = headNode
				mergedList.Val = list2.Val
			} else {
				mergedList.Next = &ListNode{}
				mergedList.Next.Val = list2.Val
				mergedList = mergedList.Next
			}
			list2 = list2.Next
		}
	}

	return headNode
}
