<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Traits;

use FriendsOfCat\NovaUnit\Actions\ActionNotFoundException;
use FriendsOfCat\NovaUnit\Actions\MockActionElement;
use FriendsOfCat\NovaUnit\Resources\MockResource;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionInvalidFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Actions\ActionValidFields;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceForActionTests;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceInvalidFieldsAndActions;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceInvalidFieldsetAndActionSet;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceNoFieldsOrActions;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceValidFieldsAndActions;
use FriendsOfCat\NovaUnit\Tests\TestCase;

class ActionAssertionsTest extends TestCase
{
    public function testItSucceedsIfComponentHasNoActions()
    {
        $mock = new MockResource(new ResourceNoFieldsOrActions(new MockModel()));
        $mock->assertHasNoActions();
    }

    public function testItFailsIfComponentHasActions()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel()));
        $mock->assertHasNoActions();
    }

    public function testItSucceedsIfAllActionsAreValid()
    {
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel()));
        $mock->assertHasValidActions();
    }

    public function testItFailsIfAtLeastOneActionIsNotAValidAction()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceInvalidFieldsAndActions(new MockModel()));
        $mock->assertHasValidActions();
    }

    public function testItFailsIfNotValidActionSet()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceInvalidFieldsetAndActionSet(new MockModel()));
        $mock->assertHasValidActions();
    }

    public function testItSucceedsWhenSearchingForActionByType()
    {
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel()));
        $mock->assertHasAction(ActionValidFields::class);
    }

    public function testItFailsWhenActionNotSetOnComponent()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel()));
        $mock->assertHasAction(ActionInvalidFields::class);
    }

    public function testItSucceedsWhenNoActionMatchesProvidedType()
    {
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel()));
        $mock->assertActionMissing(ActionInvalidFields::class);
    }

    public function testItFailsWhenAnActionMatchesProvidedType()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel()));
        $mock->assertActionMissing(ActionValidFields::class);
    }

    // region field
    public function testItWillReturnAnActionMockOnExistingField()
    {
        $mock = new MockResource(new ResourceForActionTests(new MockModel));
        $fieldMock = $mock->action(ActionValidFields::class);
        $this->assertInstanceOf(MockActionElement::class, $fieldMock);
    }

    public function testItWillThrowExceptionIfMockingActionThatDoesNotExist()
    {
        $this->expectException(ActionNotFoundException::class);
        $mock = new MockResource(new ResourceForActionTests(new MockModel));
        $mock->action(\stdClass::class);
    }

    // endregion
}
