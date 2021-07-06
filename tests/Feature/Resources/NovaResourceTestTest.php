<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Resources;

use FriendsOfCat\NovaUnit\Resources\InvalidNovaResourceException;
use FriendsOfCat\NovaUnit\Resources\MockResource;
use FriendsOfCat\NovaUnit\Resources\NovaResourceTest;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceValidFieldsAndActions;
use PHPUnit\Framework\TestCase;

class NovaResourceTestTest extends TestCase
{
    public $novaResourceTest;

    public function setUp(): void
    {
        parent::setUp();
        $this->novaResourceTest = new class {
            use NovaResourceTest;
        };
    }

    public function testItWillCreateAMockResourceTestClassWithValidResource()
    {
        $mock = $this->novaResourceTest->novaResource(ResourceValidFieldsAndActions::class, new MockModel());

        $this->assertInstanceOf(MockResource::class, $mock);
    }

    public function testItWillCreateAMockResourceTestClassWithValidResourceAndNoModel()
    {
        $mock = $this->novaResourceTest->novaResource(ResourceValidFieldsAndActions::class);

        $this->assertInstanceOf(MockResource::class, $mock);
    }

    public function testItWillThrowExceptionWithInvalidResource()
    {
        $this->expectException(InvalidNovaResourceException::class);
        $mock = $this->novaResourceTest->novaResource(\stdClass::class, new MockModel());
    }
}
