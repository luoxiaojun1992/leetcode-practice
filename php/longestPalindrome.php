<?php

class Solution {
    /**
     * @param String $s
     * @return String
     */
    function longestPalindrome($s) {
        $sLen = strlen($s);

        $maxPalindromeLen = 0;
        $maxPalindrome = '';

        for ($center = 0; $center < $sLen; ++$center) {
            $palindromeLen = 1;
            $palindrome = $s[$center];
            for ($left = $center - 1, $right = $center + 1; $left >= 0 && $right < $sLen; --$left, ++$right) {
                if ($s[$left] === $s[$right]) {
                    $palindromeLen += 2;
                    $palindrome = ($s[$left] . $palindrome . $s[$right]);
                } else {
                    break;
                }
            }
            if ($palindromeLen > $maxPalindromeLen) {
                $maxPalindromeLen = $palindromeLen;
                $maxPalindrome = $palindrome;
            }

            $palindromeLen = 0;
            $palindrome = '';
            for ($left = $center, $right = $center + 1; $left >= 0 && $right < $sLen; --$left, ++$right) {
                if ($s[$left] === $s[$right]) {
                    $palindromeLen += 2;
                    $palindrome = ($s[$left] . $palindrome . $s[$right]);
                } else {
                    break;
                }
            }
            if ($palindromeLen > $maxPalindromeLen) {
                $maxPalindromeLen = $palindromeLen;
                $maxPalindrome = $palindrome;
            }
        }

        return $maxPalindrome;
    }
}

var_dump(
    (new Solution())->longestPalindrome('babad')
);
