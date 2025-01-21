<?php

require 'vendor/autoload.php';

function printArr(array $arr)
{
    $str = '';

    foreach($arr as $item)
    {
        $str .= is_string($item) ? $item : '';
    }

    echo $str.PHP_EOL;
}

$str = '1*(2-3)+4/5-6';
echo $str.PHP_EOL;

$a = new Spartak\Postfix\Infix();

$res = $a->prepare($str);

printArr($res);

$postfix = new Spartak\Postfix\Postfix();

$res = $postfix->prepare($res);

printArr($res);

$calc = new Spartak\Postfix\Calculate();

$res = $calc->handler($str);