<?php

class WordDictionary {
    protected $hashMap;

    /**
     * Initialize your data structure here.
     */
    function __construct() {
        $this->hashMap = [[], false];
    }

    /**
     * @param String $word
     * @return NULL
     */
    function addWord($word) {
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
     * @param String $word
     * @return Boolean
     */
    function search($word) {
        $hashMapArr = [$this->hashMap];
        $wordLen = strlen($word);
        for ($i = 0; $i < $wordLen; ++$i) {
            $newHashMapArr = [];
            if ($word[$i] !== '.') {
                foreach ($hashMapArr as $hashMap) {
                    if (isset($hashMap[0][$word[$i]])) {
                        $newHashMapArr[] = $hashMap[0][$word[$i]];
                    }
                }
            } else {
                foreach ($hashMapArr as $hashMap) {
                    foreach ($hashMap[0] as $newHashMap) {
                        $newHashMapArr[] = $newHashMap;
                    }
                }
            }
            $hashMapArr = $newHashMapArr;
            if (empty($hashMapArr)) {
                break;
            }
        }

        if (empty($hashMapArr)) {
            return false;
        }

        foreach ($hashMapArr as $hashMap) {
            if ($hashMap[1]) {
                return true;
            }
        }

        return false;
    }
}

$wd = new WordDictionary();
$wd->addWord('bad');
var_dump($wd->search('bad'));
var_dump($wd->search('.ad'));
var_dump($wd->search('ba.'));
var_dump($wd->search('b.d'));
var_dump($wd->search('good'));
