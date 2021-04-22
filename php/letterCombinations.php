<?php

class Solution {

    /**
     * @param String $digits
     * @return String[]
     */
    function letterCombinations($digits) {
        $strLen = strlen($digits);
        $multiAlphas = [];
        for($i = 0; $i < $strLen; ++$i) {
            switch($digits[$i]) {
                case '2':
                    $multiAlphas[] = ['a', 'b', 'c'];
                    break;
                case '3':
                    $multiAlphas[] = ['d', 'e', 'f'];
                    break;
                case '4':
                    $multiAlphas[] = ['g', 'h', 'i'];
                    break;
                case '5':
                    $multiAlphas[] = ['j', 'k', 'l'];
                    break;
                case '6':
                    $multiAlphas[] = ['m', 'n', 'o'];
                    break;
                case '7':
                    $multiAlphas[] = ['p', 'q', 'r', 's'];
                    break;
                case '8':
                    $multiAlphas[] = ['t', 'u', 'v'];
                    break;
                case '9':
                    $multiAlphas[] = ['w', 'x', 'y', 'z'];
                    break;
            }
        }
        $lastAlphas = array_pop($multiAlphas);
        if (!is_null($lastAlphas)) {
            array_push($multiAlphas, $lastAlphas);
        } else {
            return [];
        }

        $arrangeFunc = null;
        $arrangeFunc = function ($multiAlphas) use (&$arrangeFunc) {
            $alphas = array_shift($multiAlphas);
            if (is_null($alphas)) {
                return [];
            }
            $subCombinations = $arrangeFunc($multiAlphas);
            $result = [];
            foreach ($alphas as $alpha) {
                $combination = $alpha;
                $hasSubCombinations = false;
                foreach ($subCombinations as $subCombination) {
                    $hasSubCombinations = true;
                    $result[] = $combination . $subCombination;
                }
                if (!$hasSubCombinations) {
                    $result[] = $combination;
                }
            }
            return $result;
        };

        return $arrangeFunc($multiAlphas);
    }
}

var_dump(
    (new Solution())->letterCombinations('234')
);
