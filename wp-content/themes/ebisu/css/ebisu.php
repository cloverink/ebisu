<?php
header('Content-Type: text/css');
require "less/lessc.inc.php";

$less = new lessc;
$buffer = $less->compileFile("base.less");
$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);

// Remove space after colons
$buffer = str_replace(': ', ':', $buffer);

// Remove whitespace
$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);

echo "$buffer";