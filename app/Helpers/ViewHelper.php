<?php

use Illuminate\Support\Facades\View;

if (!function_exists('includeAsJsString')) {
    function includeAsJsString($template, array $params = [])
    {
        $string = View::make($template, $params);
        return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string) $string), "\0..\37'\\")));
    }
}
