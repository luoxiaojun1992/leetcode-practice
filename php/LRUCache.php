<?php

class LRUCache {
    protected $container = [];
    protected $containerSize = 0;
    protected $posMap = [];
    protected $list = [];
    protected $capacity;

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        $this->refresh($key);
        return array_key_exists($key, $this->container) ? ($this->container[$key]) : -1;
    }

    function refresh($key) {
        if (array_key_exists($key, $this->container)) {
            $oldPos = $this->posMap[$key];
            unset($this->list[$oldPos]);
            if (end($this->list) !== false) {
                $pos = key($this->list) + 1;
            } else {
                $pos = 0;
            }
            $this->list[$pos] = $key;
            $this->posMap[$key] = $pos;
        }
    }

    function gc() {
        if ($this->containerSize > $this->capacity) {
            $key = reset($this->list);
            if ($key !== false) {
                $pos = key($this->list);
                unset($this->list[$pos]);
                unset($this->container[$key]);
                --$this->containerSize;
                unset($this->posMap[$key]);
            }
        }
    }

    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if (!array_key_exists($key, $this->container)) {
            if (end($this->list) !== false) {
                $pos = key($this->list) + 1;
            } else {
                $pos = 0;
            }
            $this->list[$pos] = $key;
            $this->posMap[$key] = $pos;
            ++$this->containerSize;
            $this->gc();
        } else {
            $this->refresh($key);
        }
        $this->container[$key] = $value;
        return null;
    }
}

$lRUCache = new LRUCache(3);
$lRUCache->put(1, 1);
$lRUCache->put(2, 2);
$lRUCache->put(3, 3);
$lRUCache->put(4, 4);
var_dump($lRUCache->get(4));
var_dump($lRUCache->get(3));
var_dump($lRUCache->get(2));
var_dump($lRUCache->get(1));
$lRUCache->put(5, 5);
var_dump($lRUCache->get(1));
var_dump($lRUCache->get(2));
var_dump($lRUCache->get(3));
var_dump($lRUCache->get(4));
var_dump($lRUCache->get(5));




