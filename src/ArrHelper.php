<?php

namespace Smoren\Helpers;

use Smoren\ExtendedExceptions\BadDataException;

/**
 * Класс для действий над массивами
 * @package Smoren\Helpers
 */
class ArrHelper
{
    /**
     * @param array $array
     * @return mixed
     * @throws BadDataException
     */
    public static function first(array &$array)
    {
        return $array[static::firstKey($array)];
    }

    /**
     * @param array $array
     * @return mixed
     * @throws BadDataException
     */
    public static function last(array &$array)
    {
        return $array[static::lastKey($array)];
    }

    /**
     * @param array $array
     * @return int|string
     * @throws BadDataException
     */
    public static function firstKey(array &$array)
    {
        foreach($array as $key => $unused) {
            return $key;
        }
        throw new BadDataException("array is empty", 1);
    }

    /**
     * @param array $array
     * @return int|string|null
     * @throws BadDataException
     */
    public static function lastKey(array &$array) {
        if(empty($array)) {
            throw new BadDataException("array is empty", 1);
        }

        return key(array_slice($array, -1, 1, true));
    }

    /**
     * @param array $array
     * @param callable $groupBy
     * @param callable|null $indexBy
     * @return array
     */
    public static function group(Iterable &$array, callable $groupBy, ?callable $indexBy = null): array
    {
        $result = [];
        foreach($array as &$item) {
            $groupValue = $groupBy($item);
            if(!isset($result[$groupValue])) {
                $result[$groupValue] = [];
            }
            if($indexBy !== null) {
                $indexValue = $indexBy($item);
                $result[$groupValue][$indexValue] = $item;
            } else {
                $result[$groupValue][] = $item;
            }
        }
        unset($item);

        return $result;
    }

    /**
     * @param array $array
     * @param callable $filter
     * @param bool $saveKeys
     * @return array
     */
    public static function filter(Iterable &$array, callable $filter, bool $saveKeys = false): array
    {
        $result = [];

        foreach($array as $key => &$item) {
            if($filter($item)) {
                if($saveKeys) {
                    $result[$key] = $item;
                } else {
                    $result[] = $item;
                }
            }
        }
        unset($item);

        return $result;
    }

    /**
     * @param array $array
     * @param callable $getValue
     * @return mixed|null
     */
    public static function max(Iterable &$array, callable $getValue)
    {
        $maxValue = null;
        $result = null;

        foreach($array as &$item) {
            if($maxValue === null) {
                $maxValue = $getValue($item);
                $result = $item;
                continue;
            }
            $newValue = $getValue($item);
            if($newValue > $maxValue) {
                $maxValue = $newValue;
                $result = $item;
            }
        }
        unset($item);

        return $result;
    }

    /**
     * @param array $array
     * @param callable $getValue
     * @return mixed|null
     */
    public static function min(Iterable &$array, callable $getValue)
    {
        $minValue = null;
        $result = null;

        foreach($array as &$item) {
            if($minValue === null) {
                $minValue = $getValue($item);
                $result = $item;
                continue;
            }
            $newValue = $getValue($item);
            if($newValue < $minValue) {
                $minValue = $newValue;
                $result = $item;
            }
        }
        unset($item);

        return $result;
    }

    /**
     * @param array $array
     * @param callable $getValue
     * @param bool $valuesOnly
     * @return array
     */
    public static function getUniqueValueEntries(Iterable &$array, callable $getValue, bool $valuesOnly = false): array
    {
        $result = [];

        foreach($array as &$item) {
            $val = $getValue($item);
            if(!isset($result[$val])) {
                $result[$val] = $valuesOnly ? $val : 1;
            } elseif(!$valuesOnly) {
                $result[$val]++;
            }
        }
        unset($item);

        return $valuesOnly ? array_values($result) : $result;
    }

    /**
     * Returns true if array is associative else false
     * @param array $input array to check
     * @return bool result flag
     */
    public static function isAssoc(array $input): bool
    {
        if([] === $input) return false;
        return array_keys($input) !== range(0, count($input) - 1);
    }

    /**
     * Flattens an array
     * @param array $arr array to flatten
     * @return array flat array
     */
    public static function flatten(array $arr): array
    {
        $tmp = [];
        foreach($arr as $val) {
            if(is_array($val)) {
                $tmp = array_merge($tmp, static::flatten($val));
            } else {
                $tmp[] = $val;
            }
        }

        return $tmp;
    }
}
