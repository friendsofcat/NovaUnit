<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Actions;

use FriendsOfCat\NovaUnit\Actions\MockAction;
use FriendsOfCat\NovaUnit\Actions\MockActionResponse;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionValidFields;
use FriendsOfCat\NovaUnit\Tests\TestCase;

class MockActionTest extends TestCase
{
    public function testItReturnsAMockActionOnHandle()
    {
        $mockAction = new MockAction(new ActionValidFields());
        $mockResult = $mockAction->handle([], []);

        $this->assertInstanceOf(MockActionResponse::class, $mockResult);
    }
}
