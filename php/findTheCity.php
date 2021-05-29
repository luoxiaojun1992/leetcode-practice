<?php

class Solution {

    /**
     * @param Integer $n
     * @param Integer[][] $edges
     * @param Integer $distanceThreshold
     * @return Integer
     */
    function findTheCity($n, $edges, $distanceThreshold) {
        $weights = [];
        $nodeEdges = [];
        foreach ($edges as $edge) {
            $weights[$edge[0]][$edge[1]] = $edge[2];
            $nodeEdges[$edge[0]][] = $edge[1];
            $weights[$edge[1]][$edge[0]] = $edge[2];
            $nodeEdges[$edge[1]][] = $edge[0];
        }

        $originQueue = new class extends SplPriorityQueue {
            public function compare($priority1, $priority2)
            {
                return -1 * ($priority1 <=> $priority2);
            }
        };

        $minCityCount = null;
        $cityCounts =  [];
        $node2NodeConnected = [];
//        $path = [];
        for ($i = $n - 1; $i >= 0; --$i) {
            if (!isset($nodeEdges[$i])) {
                $cityCounts[$i] = 0;
            } else {
                if (min($weights[$i]) > $distanceThreshold) {
                    $cityCounts[$i] = 0;
                } else {
                    for ($j = $n - 1; $j >= 0; --$j) {
                        if ($i === $j) {
                            continue;
                        }

                        if (!isset($nodeEdges[$j])) {
                            $node2NodeConnected[$i][$j] = false;
                            continue;
                        } else {
                            if (min($weights[$j]) > $distanceThreshold) {
                                $node2NodeConnected[$i][$j] = false;
                                continue;
                            }
                        }

                        if (isset($node2NodeConnected[$j][$i])) {
                            if ($node2NodeConnected[$j][$i]) {
                                if (isset($cityCounts[$i])) {
                                    ++$cityCounts[$i];
                                } else {
                                    $cityCounts[$i] = 1;
                                }
                                if (!is_null($minCityCount)) {
                                    if ($cityCounts[$i] >= $minCityCount) {
                                        break;
                                    }
                                }
                            }
                            continue;
                        }

                        if (isset($weights[$i][$j])) {
                            if ($weights[$i][$j] <= $distanceThreshold) {
                                $node2NodeConnected[$i][$j] = true;
                                if (isset($cityCounts[$i])) {
                                    ++$cityCounts[$i];
                                } else {
                                    $cityCounts[$i] = 1;
                                }
                                if (!is_null($minCityCount)) {
                                    if ($cityCounts[$i] >= $minCityCount) {
                                        break;
                                    }
                                }
                                continue;
                            }
                        }

                        $queue = clone $originQueue;
                        $queue->setExtractFlags(SplPriorityQueue::EXTR_BOTH);
                        $queue->insert([$i, $i], 0);
                        $scanned = [];
                        while (!$queue->isEmpty()) {
                            $node = $queue->extract();
                            if (isset($scanned[$node['data'][1]])) {
                                continue;
                            }

                            $scanned[$node['data'][1]] = true;
//                    $path[$i][$j][] = [$node['data'][0], $node['data'][1]];
                            if ($node['data'][1] === $j) {
                                if ($node['priority'] <= $distanceThreshold) {
                                    $node2NodeConnected[$i][$j] = true;
                                    if (isset($cityCounts[$i])) {
                                        ++$cityCounts[$i];
                                    } else {
                                        $cityCounts[$i] = 1;
                                    }
                                    if (!is_null($minCityCount)) {
                                        if ($cityCounts[$i] >= $minCityCount) {
                                            break 2;
                                        }
                                    }
                                } else {
                                    $node2NodeConnected[$i][$j] = false;
                                }
                                break;
                            }
                            if (isset($nodeEdges[$node['data'][1]])) {
                                foreach ($nodeEdges[$node['data'][1]] as $nextNode) {
                                    if (isset($scanned[$nextNode])) {
                                        continue;
                                    }
                                    $nextNodeWeight = $weights[$node['data'][1]][$nextNode] + $node['priority'];
                                    if ($nextNodeWeight > $distanceThreshold) {
                                        continue;
                                    }
                                    $queue->insert(
                                        [$node['data'][1], $nextNode],
                                        $nextNodeWeight
                                    );
                                }
                            }
                        }

                        if (!isset($node2NodeConnected[$i][$j])) {
                            $node2NodeConnected[$i][$j] = false;
                        }
                    }
                }
            }

            if (!isset($cityCounts[$i])) {
                $cityCounts[$i] = 0;
            }

            if (is_null($minCityCount)) {
                $minCityCount = $cityCounts[$i];
            } else {
                if ($cityCounts[$i] < $minCityCount) {
                    $minCityCount = $cityCounts[$i];
                }
            }

            if ($cityCounts[$i] === 0) {
                break;
            }
        }

//        $realPathList = [];
//
//        foreach ($path as $start => $endPath) {
//            foreach ($endPath as $end => $dirs) {
//                $dirsCount = count($dirs);
//                if ($dirs[$dirsCount - 1][1] !== $end) {
//                    continue;
//                }
//                $realPath = [];
//                for ($i = $dirsCount - 1; $i >= 0; --$i) {
//                    $dir = $dirs[$i];
//                    $prev = array_shift($realPath);
//                    if (is_null($prev)) {
//                        array_unshift($realPath, $dir[1]);
//                        if ($dir[0] !== $dir[1]) {
//                            array_unshift($realPath, $dir[0]);
//                        }
//                    } else {
//                        array_unshift($realPath, $prev);
//                        if ($dir[1] === $prev) {
//                            if ($dir[0] !== $dir[1]) {
//                                array_unshift($realPath, $dir[0]);
//                            }
//                        }
//                    }
//                }
//                $realPathList[] = $realPath;
//            }
//        }
//
//        $cityCounts =  [];
//
//        foreach ($realPathList as $pathList) {
//            $weightTotal = 0;
//            foreach ($pathList as $i => $node) {
//                if ($i > 0) {
//                    $weightTotal += $weights[$pathList[$i - 1]][$node];
//                }
//            }
//            if ($weightTotal > $distanceThreshold) {
//                continue;
//            }
//
//            if (isset($cityCounts[$pathList[0]])) {
//                ++$cityCounts[$pathList[0]];
//            } else {
//                $cityCounts[$pathList[0]] = 1;
//            }
//        }
//
//        for ($i = 0; $i < $n; ++$i) {
//            if (!array_key_exists($i, $cityCounts)) {
//                $cityCounts[$i] = 0;
//            }
//        }

        asort($cityCounts);

        $minCities = [];
        $minCityCount = null;

        foreach ($cityCounts as $node => $cityCount) {
            if (is_null($minCityCount)) {
                $minCities[] = $node;
                $minCityCount = $cityCount;
            } else {
                if ($cityCount === $minCityCount) {
                    $minCities[] = $node;
                } else {
                    break;
                }
            }
        }

        return max($minCities);
    }
}

var_dump(
    (new Solution())->findTheCity(
        5,
[[0,1,2],[0,4,8],[1,2,3],[1,4,2],[2,3,1],[3,4,1]],
2
    )
);
