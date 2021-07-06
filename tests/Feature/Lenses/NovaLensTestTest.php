<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Lenses;

use FriendsOfCat\NovaUnit\Lenses\InvalidNovaLensException;
use FriendsOfCat\NovaUnit\Lenses\MockLens;
use FriendsOfCat\NovaUnit\Lenses\NovaLensTest;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Lenses\LensValidFieldsAndActions;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use PHPUnit\Framework\TestCase;

class NovaLensTestTest extends TestCase
{
    public $novaLensTest;

    public function setUp(): void
    {
        parent::setUp();
        $this->novaLensTest = new class {
            use NovaLensTest;
        };
    }

    public function testItWillCreateAMockLensTestClassWithValidLens()
    {
        $mock = $this->novaLensTest->novaLens(LensValidFieldsAndActions::class, MockModel::class);

        $this->assertInstanceOf(MockLens::class, $mock);
    }

    public function testItWillThrowExceptionWithNoValidLens()
    {
        $this->expectException(InvalidNovaLensException::class);
        $mock = $this->novaLensTest->novaLens(\stdClass::class, MockModel::class);
    }
}
