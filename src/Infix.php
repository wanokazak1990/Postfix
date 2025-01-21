<?php

namespace Spartak\Postfix;

Use Spartak\Postfix\Operand;

Class Infix
{
    public function prepare(string $str)
    {
        $infix = array();
        $strLen = mb_strlen($str);
        $tmpVal = '';

        for($i = 0; $i < $strLen; $i++)
        {
            if(Operand::isOperand($str[$i]))
            {
                if($tmpVal)
                    array_push($infix, $tmpVal);
                array_push($infix,$str[$i]);
                $tmpVal = '';
            }
            
            elseif($str[$i] == '(' || $str[$i] == ')')
            {
                if($tmpVal)
                    array_push($infix, $tmpVal);
                $tmpVal = '';
                array_push($infix, $str[$i]);
            }

            else
            {
                $tmpVal .= $str[$i];
            }

            if($i == $strLen-1)
                if($tmpVal)
                    array_push($infix, $tmpVal);
        }

        return $infix;
    }
}