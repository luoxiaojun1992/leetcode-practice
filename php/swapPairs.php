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
     * @return ListNode
     */
    function swapPairs($head) {
        $listHead = $head;
        if (!is_null($head->next)) {
            $listHead = $head->next;
        }
        while (!is_null($head)) {
            $next = $head->next;
            if (!is_null($next)) {
                $newHead = $next->next;
                if (is_null($next->next)) {
                    $head->next = null;
                } else {
                    if (is_null($next->next->next)) {
                        $head->next = $next->next;
                    } else {
                        $head->next = $next->next->next;
                    }
                }
                $next->next = $head;
                $head = $newHead;
            } else {
                $head = null;
            }
        }
        return $listHead;
    }
}

var_dump(
    (new Solution())->swapPairs(
        (new ListNode(
            1,
            (new ListNode(
                2,
                (new ListNode(
                    3,
                    (new ListNode(4))
                ))
            ))
        ))
    )
);
