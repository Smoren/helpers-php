<?php

namespace Smoren\Helpers;

/**
 * @deprecated moved to smoren/tree-tools as TreeBuilder
 * @see https://github.com/Smoren/tree-tools-php#tree-builder-1
 */
class TreeHelper
{
    public static function fromList(
        iterable $list,
        string $idField = 'id',
        string $parentIdField = 'parent_id',
        string $childrenContainerField = 'items'
    ): array {
        $result = [];
        $map = [];

        foreach($list as $item) {
            $item[$childrenContainerField] = [];
            $map[$item[$idField]] = $item;
        }

        foreach($map as &$item) {
            if(isset($item[$parentIdField])) {
                $map[$item[$parentIdField]][$childrenContainerField][] = &$item;
            } else {
                $result[] = &$item;
            }
        }

        return $result;
    }
}
