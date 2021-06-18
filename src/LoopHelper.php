<?php


namespace Smoren\Helpers;


class LoopHelper
{
    public static function eachPair(array &$arr, callable $callback): int
    {
        $loopCount = 0;
        $prevKey = null;
        $prevValue = null;
        foreach($arr as $key => &$value) {
            if($prevValue === null) {
                $prevKey = $key;
                $prevValue = &$value;
                continue;
            }

            $callback($prevValue, $value, $prevKey, $key);
            $loopCount++;
            $prevKey = $key;
            $prevValue = &$value;
        }

        return $loopCount;
    }
}
