<?php

class ListNode
{
    public $val = 0;
    public $next = null;

    function __construct($val = 0, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val = 0, $next = null) {
 *         $this->val = $val;
 *         $this->next = $next;
 *     }
 * }
 */
class Solution {

    /**
     * @param ListNode $head
     * @param Integer $n
     * @return ListNode
     */
    function removeNthFromEnd($head, $n) {
        $listHead = $head;
        $n = $n + 1;
        $nodes = [$head];
        $nodeCount = 1;
        while (!is_null($head->next)) {
            $nodes[] = $head->next;
            $head = $head->next;
            if ($nodeCount <= $n) {
                ++$nodeCount;
            }
            if ($nodeCount > $n) {
                array_shift($nodes);
            }
        }
        if ($nodeCount < $n) {
            if ($nodeCount === ($n - 1)) {
                return $listHead->next;
            }
            return $listHead;
        }
        $firstNode = array_shift($nodes);
        if (!is_null($firstNode->next)) {
            if (is_null($firstNode->next->next)) {
                $firstNode->next = null;
            } else {
                $firstNode->next = $firstNode->next->next;
            }
        }
        return $listHead;
    }
}

var_dump(
    (new Solution())->removeNthFromEnd(
        (new ListNode(
            1,
            (new ListNode(
                2,
                (new ListNode(
                    3,
                    (new ListNode(
                        4,
                        (new ListNode(5))
                    ))
                ))
            ))
        )),
        2
    )->val
);
