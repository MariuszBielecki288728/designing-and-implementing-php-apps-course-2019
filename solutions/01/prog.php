<?php

$pattern = array_combine(str_split($argv[1]), str_split($argv[2]));
$subject = $argv[3];

echo cipher($subject, $pattern)."\n";


function cipher(string $subject, array $pattern) : string
{
    return strtr($subject, $pattern);
}
