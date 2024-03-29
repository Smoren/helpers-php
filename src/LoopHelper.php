<?php

namespace Smoren\Helpers;

/**
 * @deprecated use Single::pairwise() from markrogoyski/itertools-php
 * @see https://github.com/markrogoyski/itertools-php#Pairwise
 */
class LoopHelper
{
    /**
     * @param array $arr
     * @param callable $callback
     * @return int
     */
    public static function eachPair(Iterable &$arr, callable $callback): int
    {
        $loopCount = 0;
        $prevKey = null;
        $prevValue = null;

        if(is_array($arr)) {
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
        } else {
            foreach($arr as $key => $value) {
                if($prevValue === null) {
                    $prevKey = $key;
                    $prevValue = $value;
                    continue;
                }

                $callback($prevValue, $value, $prevKey, $key);
                $loopCount++;
                $prevKey = $key;
                $prevValue = $value;
            }
        }

        return $loopCount;
    }
}
