<?php

class Trie {
    protected $hashMap;

    /**
     * Initialize your data structure here.
     */
    function __construct() {
        $this->hashMap = [[], false];
    }

    /**
     * Inserts a word into the trie.
     * @param String $word
     * @return NULL
     */
    function insert($word) {
        $hashMap = &$this->hashMap;
        $wordLen = strlen($word);
        for ($i = 0; $i < $wordLen; ++$i) {
            if (isset($hashMap[0][$word[$i]])) {
                $hashMap = &$hashMap[0][$word[$i]];
                if ($i === ($wordLen - 1)) {
                    $hashMap[1] = true;
                }
            } else {
                if ($i ===  ($wordLen - 1)) {
                    $isEnd = true;
                } else {
                    $isEnd = false;
                }
                $newHashMap = [[], $isEnd];
                $hashMap[0][$word[$i]] = $newHashMap;
                $hashMap = &$hashMap[0][$word[$i]];
            }
        }
        return null;
    }

    /**
     * Returns if the word is in the trie.
     * @param String $word
     * @return Boolean
     */
    function search($word) {
        $hashMap = $this->hashMap;
        $wordLen = strlen($word);
        for ($i = 0; $i < $wordLen; ++$i) {
            if (isset($hashMap[0][$word[$i]])) {
                $hashMap = $hashMap[0][$word[$i]];
            } else {
                return false;
            }
        }
        return $hashMap[1];
    }

    /**
     * Returns if there is any word in the trie that starts with the given prefix.
     * @param String $prefix
     * @return Boolean
     */
    function startsWith($prefix) {
        $hashMap = $this->hashMap;
        $wordLen = strlen($prefix);
        for ($i = 0; $i < $wordLen; ++$i) {
            if (isset($hashMap[0][$prefix[$i]])) {
                $hashMap = $hashMap[0][$prefix[$i]];
            } else {
                return false;
            }
        }
        return true;
    }
}

$trie = new Trie();
$trie->insert('apple');
var_dump(
    $trie->search('apple')
);
var_dump(
    $trie->startsWith('app')
);
var_dump(
    $trie->search('app')
);
