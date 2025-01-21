<?php

namespace Spartak\Postfix;

use Spartak\Postfix\Infix;
use Spartak\Postfix\Postfix;

Class Calculate
{
    private $infix;
    private $postfix;

    public function __construct()
    {
        $this->infix = new Infix();

        $this->postfix = new Postfix(); 
    }



    public function handler(string $str)
    {
        $res = $this->postfix->prepare($this->infix->prepare($str));

        
    }
}