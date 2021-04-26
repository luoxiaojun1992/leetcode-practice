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
     * @param Integer $k
     * @return ListNode
     */
    function rotateRight($head, $k) {
        if (is_null($head)) {
            return null;
        }
        if (is_null($head->next)) {
            return $head;
        }

        while ($k > 0) {
            $listHead = $head;
            $nodes = [];
            $nodeCount = 0;
            $n = $k + 1;

            while (!is_null($head)) {
                if ($nodeCount >= $n) {
                    array_shift($nodes);
                }
                $nodes[] = $head;
                if ($nodeCount < $n) {
                    ++$nodeCount;
                }
                $head = $head->next;
            }

            if ($nodeCount < $n) {
                $k = $k - ($nodeCount - 1);
                if ($k > $nodeCount) {
                    $k = $k % $nodeCount;
                }
            } else {
                $k = 0;
            }

            $newLastNode = array_shift($nodes);
            $newLastNode->next = null;
            $lastNode = array_pop($nodes);
            $lastNode->next = $listHead;

            $head = array_shift($nodes);
            if (is_null($head)) {
                $head = $lastNode;
            }
        }

        return $head;
    }
}

var_dump(
    (new Solution())->rotateRight(
        (new ListNode(
            1,
            (new ListNode(
                2
            ))
        )),
        1
    )
);
