<?php

class Solution {

    /**
     * @param Integer[] $postorder
     * @return Boolean
     */
    function verifyPostorder($postorder)
    {
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
                            array_pop($subPostorder);
                            $lt = array_pop($subPostorder);
                            $resultWhenRightLeftNode = call_user_func(
                                $verifyPostorderFunc,
                                $subPostorder,
                                $lt,
                                $gt
                            );
                        }

                        $subPostorder = $postorder;
                        $gt = array_pop($subPostorder);
                        $resultWhenRightSubNode = call_user_func(
                            $verifyPostorderFunc,
                            $subPostorder,
                            $lt,
                            $gt
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
                    $lt = array_pop($subPostorder);
                    $resultWhenLeftNode = call_user_func(
                        $verifyPostorderFunc,
                        $subPostorder,
                        $lt,
                        $gt
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
    (new Solution())->verifyPostorder([4, 8, 6, 12, 16, 14, 10])
);
