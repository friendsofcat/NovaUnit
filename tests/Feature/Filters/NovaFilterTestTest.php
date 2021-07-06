<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Filters;

use FriendsOfCat\NovaUnit\Filters\InvalidNovaFilterException;
use FriendsOfCat\NovaUnit\Filters\MockFilter;
use FriendsOfCat\NovaUnit\Filters\NovaFilterTest;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeSelectFilter;
use PHPUnit\Framework\TestCase;

class NovaFilterTestTest extends TestCase
{
    public $novaFilterTest;

    public function setUp(): void
    {
        parent::setUp();
        $this->novaFilterTest = new class {
            use NovaFilterTest;
        };
    }

    public function testItWillCreateAMockLensTestClassWithValidLens()
    {
        $mock = $this->novaFilterTest->novaFilter(FakeSelectFilter::class);

        $this->assertInstanceOf(MockFilter::class, $mock);
    }

    public function testItWillThrowExceptionWithNoValidLens()
    {
        $this->expectException(InvalidNovaFilterException::class);
        $this->novaFilterTest->novaFilter(\stdClass::class);
    }
}
