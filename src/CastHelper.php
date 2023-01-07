<?php

namespace Smoren\Helpers;

/**
 * Class CastHelper
 * @package Smoren\Helpers
 * @deprecated moved to smoren/type-tools as ObjectTypeCaster
 * @see https://github.com/Smoren/type-tools-php#object-type-caster-1
 */
class CastHelper
{
    /**
     * Приводит объект к другому типу
     * @param $sourceObject
     * @param string $destinationClass
     * @return mixed
     */
    public static function castObject($sourceObject, string $destinationClass)
    {
        return unserialize(sprintf(
            'O:%d:"%s"%s',
            strlen($destinationClass),
            $destinationClass,
            strstr(strstr(serialize($sourceObject), '"'), ':')
        ));
    }
}
