<?php

if (! function_exists('generate_slug')) {
    function generate_slug($string): string
    {
        $string = str_replace(' ', '-', $string);

        return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $string));
    }
}
