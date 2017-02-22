<?php

namespace calculator\V1\Rest\Expressions;

use Exception;

class Evaluator
{
    const ADD = "+";
    const SUB = "-";
    const MUL = "*";
    const DIV = "/";

    /**
     * @param  string $op
     * @param  int    $left
     * @param  int    $right
     * @return int
     */
    public static function evaluateBinary($op, $left, $right)
    {
        switch ($op) {
            case self::ADD:
                return intval($left + $right);
            case self::SUB:
                return intval($left - $right);
            case self::MUL:
                return intval($left * $right);
            case self::DIV:
                return intval($left / $right);
            default:
                throw new Exception("operator `$op` not implemented");
        }
    }
}
