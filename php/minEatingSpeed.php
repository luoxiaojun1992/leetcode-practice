<?php

class Solution
{

    /**
     * @param Integer[] $piles
     * @param Integer $h
     * @return Integer
     */
    function minEatingSpeed($piles, $h)
    {
        $totalPiles = array_sum($piles);
        $minSpeed = intval(ceil($totalPiles / $h));
        $maxSpeed = $totalPiles;
        $medianSpeed = intval(floor(($maxSpeed + $minSpeed) / 2));
        $actualSpeed = $medianSpeed;

        do {
            $actualH = 0;
            foreach ($piles as $pileCount) {
                if ($pileCount <= $actualSpeed) {
                    ++$actualH;
                } else {
                    $actualH += intval(ceil($pileCount / $actualSpeed));
                }
            }

            if ($actualH > $h) {
                if ($maxSpeed - $minSpeed === 1) {
                    $minSpeed = $maxSpeed;
                    $medianSpeed = $minSpeed;
                    $actualSpeed = $minSpeed;
                } else {
                    $minSpeed = $medianSpeed;
                    $medianSpeed = intval(floor(($maxSpeed + $minSpeed) / 2));
                    $actualSpeed = $medianSpeed;
                }
            } else {
                $maxSpeed = $medianSpeed;
                $medianSpeed = intval(floor(($maxSpeed + $minSpeed) / 2));
                $actualSpeed = $medianSpeed;
            }
        } while ($minSpeed < $maxSpeed);

        return $actualSpeed;
    }
}

var_dump(
    (new Solution())->minEatingSpeed(
        [30,11,23,4,20], 5
    )
);
