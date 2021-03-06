<?php

require __DIR__ . '/../vendor/autoload.php';

use PhpLang\Phack\Test;

class PhackTypedPropTest extends PHPUnit_Framework_TestCase {
    use Test\AssertTranspilesTrait;

    public function testUntyped() {
        $this->assertTranspiles('class C { private $x, $y; }',
                                'class C { private $x, $y; }');
    }

    public function testPartialTyped() {
        $this->assertTranspiles('class C { private $x = 1, $y; }',
                                'class C { private $x = 1, int $y; }');
    }

    public function testFullyTyped() {
        $this->assertTranspiles('class C { private $x = 2, $y; }',
                                'class C { private int $x = 2, string $y; }');
    }
}
