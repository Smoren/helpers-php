<?php


namespace Smoren\Helpers;


class RuleHelper
{
    /**
     * Checks rule for value
     * @param mixed $value value to check
     * @param string $rule rule for checking
     * @param array $args arguments for rule
     * @return bool
     */
    public static function check($value, string $rule, array $args): bool
    {
        switch($rule) {
            case '=':
                if((string)$value === (string)$args[0]) {
                    return true;
                }
                break;
            case '!=':
                if((string)$value !== (string)$args[0]) {
                    return true;
                }
                break;
            case '>':
                if($value > $args[0]) {
                    return true;
                }
                break;
            case '>=':
                if($value >= $args[0]) {
                    return true;
                }
                break;
            case '<':
                if($value < $args[0]) {
                    return true;
                }
                break;
            case '<=':
                if($value <= $args[0]) {
                    return true;
                }
                break;
            case 'between':
                if($value >= $args[0] && $value <= $args[1]) {
                    return true;
                }
                break;
            case 'between_strict':
                if($value > $args[0] && $value < $args[1]) {
                    return true;
                }
                break;
        }

        return false;
    }
}