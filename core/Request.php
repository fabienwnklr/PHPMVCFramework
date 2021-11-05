<?php

namespace app\core;

class Request
{
    function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if ($position === false) :
            return $path;
        endif;

        return substr($path, 0, $position);
    }

    function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}