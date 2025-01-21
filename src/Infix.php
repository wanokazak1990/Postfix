<?php

namespace Spartak\Postfix;

Use Spartak\Postfix\Operand;

Class Infix
{
    public function prepare(string $str)
    {
        $infix = array();
        $strLen = mb_strlen($str);

        for($i = 0; $i < $strLen; $i++)
        {
            if(Operand::isOperand($data[$i]))
            {

            }
            else
            {
                
            }
        }
    }
}