<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Traits;

use FriendsOfCat\NovaUnit\Resources\MockResource;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeDateFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeSelectFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceInvalidFieldsAndActions;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceInvalidFieldsetAndActionSet;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceNoFieldsOrActions;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Resources\ResourceValidFieldsAndActions;
use FriendsOfCat\NovaUnit\Tests\TestCase;

class FilterAssertionsTest extends TestCase
{
    public function testItSucceedsIfComponentHasNoFilters()
    {
        $mock = new MockResource(new ResourceNoFieldsOrActions(new MockModel));
        $mock->assertHasNoFilters();
    }

    public function testItFailsIfComponentHasFilters()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel));
        $mock->assertHasNoFilters();
    }

    public function testItSucceedsIfAllFiltersAreValid()
    {
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel));
        $mock->assertHasValidFilters();
    }

    public function testItFailsIfAtLeastOneFilterIsNotAValidFilter()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceInvalidFieldsAndActions(new MockModel));
        $mock->assertHasValidFilters();
    }

    public function testItFailsIfNotValidFilterSet()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceInvalidFieldsetAndActionSet(new MockModel));
        $mock->assertHasValidFilters();
    }

    public function testItSucceedsWhenSearchingForFilterByType()
    {
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel));
        $mock->assertHasFilter(FakeSelectFilter::class);
    }

    public function testItFailsWhenFilterNotSetOnComponent()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel));
        $mock->assertHasFilter(FakeDateFilter::class);
    }

    public function testItSucceedsWhenNoFilterMatchesProvidedType()
    {
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel));
        $mock->assertFilterMissing(FakeDateFilter::class);
    }

    public function testItFailsWhenAFilterMatchesProvidedType()
    {
        $this->shouldFail();
        $mock = new MockResource(new ResourceValidFieldsAndActions(new MockModel));
        $mock->assertFilterMissing(FakeSelectFilter::class);
    }
}
