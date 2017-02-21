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
     * @param  float  $left
     * @param  float  $right
     * @return float
     */
    public static function evaluateBinary($op, $left, $right)
    {
        switch ($op) {
            case self::ADD:
                return (float) $left + $right;
            case self::SUB:
                return (float) $left - $right;
            case self::MUL:
                return (float) $left * $right;
            case self::DIV:
                return (float) $left / $right;
            default:
                throw new Exception("not implemented");
        }
    }
}
