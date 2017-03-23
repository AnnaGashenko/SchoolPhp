<?php

interface CacheInterface
{
    public function get();
    public function set($value);
}