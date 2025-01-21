<?php

namespace Spartak\Postfix;

use \Spartak\Postfix\Operand;

Class Postfix
{
    private function ifOperand(string $item, array &$stringA, array &$opA)
    {
        $currentPriority = Operand::priority($item);
                
        if(count($opA) == 0 || end($opA) == '(')
            array_push($opA, $item);

        elseif($currentPriority > Operand::priority(end($opA)))
            array_push($opA, $item);

        elseif($currentPriority <= Operand::priority(end($opA)))
        {
            $prevPriority = (Operand::priority(end($opA)));
            while($currentPriority <= $prevPriority)
            {
                array_push($stringA, array_pop($opA));
                $prevPriority = end($opA) ? Operand::priority(end($opA)) : 0;
            }
            array_push($opA, $item);
        }
    }



    private function ifHooks(string $item, array &$stringA, array &$opA)
    {
        if($item == '(')
            array_push($opA, $item);
            
        elseif($item == ')')
        {
            $top = end($opA);
            while($top != '(')
            {
                array_push($stringA, array_pop($opA));
                $top = end($opA);
            }
            if(end($opA) == '(')
                array_pop($opA);
        }
    }



    public function prepare(array $arr)
    {
        $stringA = array(); //Результирующий массив
        $opA = array(); //стек под операторы действий
        $currentPriority = 0;

        foreach($arr as $item)
        {
            if(Operand::isOperand($item))
                $this->ifOperand($item, $stringA, $opA);
            
            elseif(Operand::isHook($item))
                $this->ifHooks($item, $stringA, $opA);

            else
                array_push($stringA, $item);

            if(!next($arr)) {
                if(count($opA))
                    while(count($opA))
                        array_push($stringA, array_pop($opA));
            }
        }
        return $stringA;
    }
}