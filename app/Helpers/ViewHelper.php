<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

function includeAsJsString($template)
{
    $string = View::make($template);
    return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
}
