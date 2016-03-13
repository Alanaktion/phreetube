<?php
namespace Helper;

class Dashboard extends \Prefab
{

    /**
     * Generate a unique alphanumeric key
     * @param int $length
     * @return string
     */
    function uniqueKey($length = 10) {
        $sha = substr(sha1(microtime()), 0, $length * 2);
        return substr(base_convert($sha, 16, 35), 0, $length);
    }

}
