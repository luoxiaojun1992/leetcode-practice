/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class Solution {

    /**
     * @param ListNode $l1
     * @param ListNode $l2
     * @return ListNode
     */
    function addTwoNumbers($l1, $l2) {
        $sum = null;
        $currentBit = null;
        $carryFlag = false;

        while ((!is_null($l1)) || (!is_null($l2)) || $carryFlag) {
            $l1Val = $l1 ? $l1->val : 0;
            $l2Val = $l2 ? $l2->val : 0;
            $valSum = $l1Val + $l2Val;
            if ($carryFlag) {
                $valSum += 1;
            }
            $carryFlag = $valSum >= 10;
            $realValSum = ($valSum < 10) ? $valSum : ($valSum - 10);
            if (is_null($sum)) {
                $sum = new ListNode($realValSum);
                $currentBit = $sum;
            } else {
                $newSum = new ListNode($realValSum);
                $currentBit->next = $newSum;
                $currentBit = $newSum;
            }

            $l1 = $l1 ? $l1->next : null;
            $l2 = $l2 ? $l2->next : null;
        }

        return $sum ? : new ListNode(0);
    }
}
