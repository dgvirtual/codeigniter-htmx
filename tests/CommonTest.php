<?php

namespace Tests;

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class CommonTest extends CIUnitTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config('Paths')->viewDirectory = SUPPORTPATH . 'Views';
    }

    public function testViewFragmentNone(): void
    {
        $data = [
            'testString1' => 'Hello World',
            'testString2' => 'Hello World',
        ];

        $expected = '';

        $this->assertSame($expected, view_fragment('view_fragment', '', $data));
    }

    public function testViewFragmentOne(): void
    {
        $data = [
            'testString1' => 'Hello World',
            'testString2' => 'Hello World',
        ];

        $expected = "Hello World, fragment1!\n";

        $this->assertSame($expected, view_fragment('view_fragment', 'sample1', $data));
    }

    public function testViewFragmentTwo(): void
    {
        $data = [
            'testString1' => 'Hello World',
            'testString2' => 'Hello World',
        ];

        $expected = "Hello World, fragment1!\nHello World, fragment2!\n";

        $this->assertSame($expected, view_fragment('view_fragment', ['sample1', 'sample2'], $data));
    }

    public function testViewFragmentSaveData(): void
    {
        $data = [
            'testString1' => 'Hello World',
            'testString2' => 'Hello World',
        ];

        $expected = "Hello World, fragment1!\nHello World, fragment2!\n";

        $this->assertSame($expected, view_fragment('view_fragment', ['sample1', 'sample2'], $data, ['saveData' => true]));
    }

    public function testViewFragmentWithLayout(): void
    {
        $data = [
            'testString1' => 'Hello World',
            'testString2' => 'Hello World',
        ];

        $expected = "Hello World, fragment1!\nHello World, fragment2!\n";

        $this->assertSame($expected, view_fragment('with_fragment', ['sample1', 'sample2'], $data));
    }

    public function testViewFragmentFromLayout(): void
    {
        $data = [
            'testString1' => 'Hello World',
            'testString2' => 'Hello World',
        ];

        $expected = 'Page bottom';

        $this->assertSame($expected, view_fragment('with_fragment', 'sample0', $data));
    }

    public function testStrContains(): void
    {
        $string = "It should start with 'It should'";

        $this->assertStringContainsString('It should', $string);
        $this->assertStringNotContainsString('It does', $string);

    }

    public function testStrStartsWith(): void
    {
        $string = "It should start with 'It should'";

        $this->assertStringStartsWith('It should', $string);
        $this->assertStringStartsNotWith('It does', $string);

    }
}
