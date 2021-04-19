<?php

class Solution {

    /**
     * @param Integer[] $postorder
     * @return Boolean
     */
    function verifyPostorder($postorder)
    {
        $verifyPostorderFunc = null;
        $verifyPostorderFunc = function ($postorder, $lt = null, $gt = null) use (&$verifyPostorderFunc) {
            $rootNode = array_pop($postorder);
            $prevNode = array_pop($postorder);
            $prevPrevNode = array_pop($postorder);
            if (!is_null($prevPrevNode)) {
                if (!is_null($lt)) {
                    if ($prevPrevNode > $lt) {
                        return false;
                    }
                }
                if (!is_null($gt)) {
                    if ($prevPrevNode < $gt) {
                        return false;
                    }
                }
                array_push($postorder, $prevPrevNode);
            }
            if (!is_null($prevNode)) {
                if (!is_null($lt)) {
                    if ($prevNode > $lt) {
                        return false;
                    }
                }
                if (!is_null($gt)) {
                    if ($prevNode < $gt) {
                        return false;
                    }
                }
                array_push($postorder, $prevNode);
            }
            if (!is_null($rootNode)) {
                if (!is_null($lt)) {
                    if ($rootNode > $lt) {
                        return false;
                    }
                }
                if (!is_null($gt)) {
                    if ($rootNode < $gt) {
                        return false;
                    }
                }
                array_push($postorder, $rootNode);
            }

            //right node
            if ((!is_null($prevNode)) && (!is_null($rootNode))) {
                $resultWhenRightNode = $prevNode > $rootNode;
                if ($resultWhenRightNode) {
                    if (!is_null($prevPrevNode)) {
                        //left node
                        $resultWhenRightLeftNode = $prevPrevNode < $rootNode;
                        if ($resultWhenRightLeftNode) {
                            $subPostorder = $postorder;
                            $newLt = array_pop($subPostorder);
                            if (!is_null($lt)) {
                                if ($lt < $newLt) {
                                    $newLt = $lt;
                                }
                            }
                            array_pop($subPostorder);
                            $resultWhenRightLeftNode = call_user_func(
                                $verifyPostorderFunc,
                                $subPostorder,
                                $newLt,
                                null
                            );
                        }

                        $subPostorder = $postorder;
                        $newGt = array_pop($subPostorder);
                        if (!is_null($gt)) {
                            if ($gt > $newGt) {
                                $newGt = $gt;
                            }
                        }
                        $resultWhenRightSubNode = call_user_func(
                            $verifyPostorderFunc,
                            $subPostorder,
                            null,
                            $newGt
                        );

                        $resultWhenRightNode = $resultWhenRightLeftNode || $resultWhenRightSubNode;
                    }
                }
            } else {
                $resultWhenRightNode = true;
            }

            //left node
            if ((!is_null($prevNode)) && (!is_null($rootNode))) {
                $resultWhenLeftNode = $prevNode < $rootNode;
                if ($resultWhenLeftNode) {
                    $subPostorder = $postorder;
                    $newLt = array_pop($subPostorder);
                    if (!is_null($lt)) {
                        if ($lt < $newLt) {
                            $newLt = $lt;
                        }
                    }
                    $resultWhenLeftNode = call_user_func(
                        $verifyPostorderFunc,
                        $subPostorder,
                        $newLt,
                        null
                    );
                }
            } else {
                $resultWhenLeftNode = true;
            }

            return $resultWhenRightNode || $resultWhenLeftNode;
        };

        return call_user_func($verifyPostorderFunc, $postorder);
    }
}

var_dump(
    (new Solution())->verifyPostorder([1,2,5,10,6,9,4,3])
);
