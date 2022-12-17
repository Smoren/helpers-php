<?php

namespace Smoren\Helpers\Tests\Unit;

use Codeception\Test\Unit;
use Smoren\ExtendedExceptions\BadDataException;
use Smoren\Helpers\EnvHelper;

class EnvHelperTest extends Unit
{
    public function testMain()
    {
        $_ENV['test'] = 1;

        $this->assertEquals(1, EnvHelper::get('test'));
        $this->assertEquals(1, EnvHelper::get('test', 11));
        $this->assertEquals(22, EnvHelper::get('another', 22));

        try {
            EnvHelper::get('another');
            $this->fail();
        } catch(BadDataException $e) {
            $this->assertEquals(1, $e->getCode());
        }
    }
}
