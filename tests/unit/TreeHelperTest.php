<?php

namespace Smoren\Helpers\Tests\Unit;


use Smoren\Helpers\TreeHelper;

class TreeHelperTest extends \Codeception\Test\Unit
{
    public function testFirst()
    {
        $input = [
            ['id' => 1, 'name' => 'Элемент 1'],
            ['id' => 2, 'name' => 'Элемент 1.1', 'parent_id' => 1],
            ['id' => 3, 'name' => 'Элемент 1.2', 'parent_id' => 1],
            ['id' => 4, 'name' => 'Элемент 1.1.1', 'parent_id' => 2],
            ['id' => 5, 'name' => 'Элемент 2'],
            ['id' => 6, 'name' => 'Элемент 3'],
            ['id' => 7, 'name' => 'Элемент 3.1', 'parent_id' => 6],
            ['id' => 8, 'name' => 'Элемент 3.2', 'parent_id' => 6],
        ];

        $output = TreeHelper::fromList($input);

        $ref = [
            [
                'id' => 1,
                'name' => 'Элемент 1',
                'items' => [
                    [
                        'id' => 2,
                        'name' => 'Элемент 1.1',
                        'parent_id' => 1,
                        'items' => [
                            [
                                'id' => 4,
                                'name' => 'Элемент 1.1.1',
                                'parent_id' => 2,
                                'items' => [],
                            ]
                        ],
                    ],
                    [
                        'id' => 3,
                        'name' => 'Элемент 1.2',
                        'parent_id' => 1,
                        'items' => [],
                    ],
                ]
            ],
            [
                'id' => 5,
                'name' => 'Элемент 2',
                'items' => [],
            ],
            [
                'id' => 6,
                'name' => 'Элемент 3',
                'items' => [
                    [
                        'id' => 7,
                        'name' => 'Элемент 3.1',
                        'parent_id' => 6,
                        'items' => [],
                    ],
                    [
                        'id' => 8,
                        'name' => 'Элемент 3.2',
                        'parent_id' => 6,
                        'items' => [],
                    ],
                ]
            ],
        ];

        $this->assertEquals($output, $ref);
    }
}