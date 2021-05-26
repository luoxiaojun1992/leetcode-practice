<?php

class Solution
{
    /**
     * @param Integer $bookCount
     * @param Integer $peopleCount
     * @param Integer[] $pageCounts
     * @return Integer[]
     */
    function minCopyTimeCost($bookCount, $peopleCount, $pageCounts)
    {
        $pagesTotal = array_sum($pageCounts);
        $minCopyTimeCost = intval(ceil($pagesTotal / $peopleCount));
        $maxCopyTimeCost = $pagesTotal - $peopleCount;
        $medianCopyTimeCost = intval(floor(($maxCopyTimeCost + $minCopyTimeCost) / 2));

        $actualCopyTimeCost = 0;

        while ($minCopyTimeCost < $maxCopyTimeCost) {
            $actualCopyTimeCost = 0;

            foreach ($pageCounts as $i => $pageCount) {
                $actualCopyTimeCost += $pageCount;
                if ($actualCopyTimeCost >= $medianCopyTimeCost) {
                    if (($bookCount - ($i + 1)) >= $peopleCount) {
                        $remainBookCount = ($bookCount - ($i + 1));
                        $secondMaxBookCount = $remainBookCount - ($peopleCount - 1);
                        $remainPageCounts = array_slice($pageCounts, $i + 1);
                        rsort($remainPageCounts);
                        $remainPageCounts = array_values($remainPageCounts);
                        $secondMaxPagesCount = array_sum(array_slice($remainPageCounts, 0, $secondMaxBookCount));

                        if ($secondMaxPagesCount >= $actualCopyTimeCost) {
                            if (($maxCopyTimeCost - $minCopyTimeCost) === 1) {
                                $minCopyTimeCost = $maxCopyTimeCost;
                                $medianCopyTimeCost = $maxCopyTimeCost;
                            } else {
                                $minCopyTimeCost = $medianCopyTimeCost;
                                $medianCopyTimeCost = intval(floor(($maxCopyTimeCost + $minCopyTimeCost) / 2));
                            }
                        } else {
                            if (($maxCopyTimeCost - $minCopyTimeCost) === 1) {
                                $maxCopyTimeCost = $minCopyTimeCost;
                                $medianCopyTimeCost = $minCopyTimeCost;
                            } else {
                                $maxCopyTimeCost = $medianCopyTimeCost;
                                $medianCopyTimeCost = intval(floor(($maxCopyTimeCost + $minCopyTimeCost) / 2));
                            }
                        }
                    } else {
                        if (($maxCopyTimeCost - $minCopyTimeCost) === 1) {
                            $maxCopyTimeCost = $minCopyTimeCost;
                            $medianCopyTimeCost = $minCopyTimeCost;
                        } else {
                            $maxCopyTimeCost = $medianCopyTimeCost;
                            $medianCopyTimeCost = intval(floor(($maxCopyTimeCost + $minCopyTimeCost) / 2));
                        }
                    }
                    break;
                }
            }

            if ($actualCopyTimeCost < $medianCopyTimeCost) {
                if (($maxCopyTimeCost - $minCopyTimeCost) === 1) {
                    $maxCopyTimeCost = $minCopyTimeCost;
                    $medianCopyTimeCost = $minCopyTimeCost;
                } else {
                    $maxCopyTimeCost = $medianCopyTimeCost;
                    $medianCopyTimeCost = intval(floor(($maxCopyTimeCost + $minCopyTimeCost) / 2));
                }
            }
        }

        $result = [];

        $peopleIndex = 0;
        $peoplePagesCount = 0;
        $peopleBookStart = 0;
        $peopleBookEnd = 0;
        foreach ($pageCounts as $i => $pageCount) {
            $peoplePagesCount += $pageCount;
            if ($peopleBookStart <= 0) {
                $peopleBookStart = ($i + 1);
            }
            if ($peoplePagesCount <= $actualCopyTimeCost) {
                $remainBookCount = $bookCount - ($i + 1);
                if ($remainBookCount < ($peopleCount - ($peopleIndex + 1))) {
                    $result[$peopleIndex] = [$peopleBookStart, $peopleBookEnd];
                    ++$peopleIndex;
                    $peoplePagesCount = $pageCount;
                    $peopleBookStart = ($i + 1);
                    $peopleBookEnd = ($i + 1);
                } else {
                    $peopleBookEnd = ($i + 1);
                }
            } else {
                if (($peopleIndex + 1) < $peopleCount) {
                    $result[$peopleIndex] = [$peopleBookStart, $peopleBookEnd];
                    ++$peopleIndex;
                    $peoplePagesCount = $pageCount;
                    $peopleBookStart = ($i + 1);
                    $peopleBookEnd = ($i + 1);
                } else {
                    $peopleBookEnd = ($i + 1);
                }
            }
            if (!isset($pageCounts[$i + 1])) {
                $result[$peopleIndex] = [$peopleBookStart, $peopleBookEnd];
            }
        }

        return $result;
    }
}

var_dump(
    (new Solution())->minCopyTimeCost(
        9, 3,
        [1, 2, 3, 4, 5, 6, 7, 8, 9]
    )
);
