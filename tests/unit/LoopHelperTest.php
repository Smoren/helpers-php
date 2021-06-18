<?php

namespace app\tests\unit;


use Smoren\Helpers\LoopHelper;

class LoopHelperTest extends \Codeception\Test\Unit
{
    public function testEachPair()
    {
        $arr = [];
        $this->assertTrue(LoopHelper::eachPair($arr, function() {}) === 0);

        $arr = [1];
        $this->assertTrue(LoopHelper::eachPair($arr, function() {}) === 0);

        $arr = [1, 2];
        $count = LoopHelper::eachPair($arr, function($lhs, $rhs, $lhsKey, $rhsKey) {
            $this->assertTrue($lhs == 1);
            $this->assertTrue($rhs == 2);
            $this->assertTrue($lhsKey == 0);
            $this->assertTrue($rhsKey == 1);
        });
        $this->assertTrue($count == 1);

        $arr = [1, 2, 3];
        $count = LoopHelper::eachPair($arr, function($lhs, $rhs, $lhsKey, $rhsKey) {
            switch($lhsKey) {
                case 0:
                    $this->assertTrue($lhs == 1);
                    $this->assertTrue($rhs == 2);
                    $this->assertTrue($rhsKey == 1);
                    break;
                case 1:
                    $this->assertTrue($lhs == 2);
                    $this->assertTrue($rhs == 3);
                    $this->assertTrue($rhsKey == 2);
                    break;
                default:
                    $this->assertTrue(false);
            }
        });
        $this->assertTrue($count == 2);

        $arr = ['a' => 1, 'b' => 2, 'c' => 3];
        $count = LoopHelper::eachPair($arr, function($lhs, $rhs, $lhsKey, $rhsKey) {
            switch($lhsKey) {
                case 'a':
                    $this->assertTrue($lhs == 1);
                    $this->assertTrue($rhs == 2);
                    $this->assertTrue($rhsKey == 'b');
                    break;
                case 'b':
                    $this->assertTrue($lhs == 2);
                    $this->assertTrue($rhs == 3);
                    $this->assertTrue($rhsKey == 'c');
                    break;
                default:
                    $this->assertTrue(false);
            }
        });
        $this->assertTrue($count == 2);

        $arr = [1, 2, 3];
        $count = LoopHelper::eachPair($arr, function(&$lhs, &$rhs) {
            $lhs += $rhs;
        });
        $this->assertTrue($count == 2);
        $this->assertTrue($arr == [3, 5, 3]);

        $arr = [1, 2, 3];
        $count = LoopHelper::eachPair($arr, function(&$lhs, &$rhs) {
            $rhs += $lhs;
        });
        $this->assertTrue($count == 2);
        $this->assertTrue($arr == [1, 3, 6]);

        $arr = array_fill(0, 1000, 5);
        $count = LoopHelper::eachPair($arr, function(&$lhs, &$rhs, $lhsKey, $rhsKey) {
            $lhs += 2;
            if($rhsKey == 999) {
                $rhs += 2;
            }
        });
        $this->assertTrue($count == 999);
        $this->assertTrue($arr == array_fill(0, 1000, 7));
    }
}