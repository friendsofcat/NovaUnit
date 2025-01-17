<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Filters;

use FriendsOfCat\NovaUnit\Exceptions\InvalidModelException;
use FriendsOfCat\NovaUnit\Filters\MockFilter;
use FriendsOfCat\NovaUnit\Filters\MockFilterQuery;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeBooleanFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeDateFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeSelectFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use FriendsOfCat\NovaUnit\Tests\TestCase;

class MockFilterTest extends TestCase
{
    // region assertSelectFilter
    public function testItSucceedsIfFilterIsASelectFilter()
    {
        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertSelectFilter();
    }

    public function testItFailsIfFilterIsNotASelectFilter()
    {
        $this->shouldFail();

        $mock = new MockFilter(new FakeDateFilter);

        $mock->assertSelectFilter();
    }

    // endregion

    // region assertBooleanFilter
    public function testItSucceedsIfFilterIsABooleanFilter()
    {
        $mock = new MockFilter(new FakeBooleanFilter);

        $mock->assertBooleanFilter();
    }

    public function testItFailsIfFilterIsNotABooleanFilter()
    {
        $this->shouldFail();

        $mock = new MockFilter(new FakeDateFilter);

        $mock->assertBooleanFilter();
    }

    // endregion

    // region assertDateFilter
    public function testItSucceedsIfFilterIsADateFilter()
    {
        $mock = new MockFilter(new FakeDateFilter);

        $mock->assertDateFilter();
    }

    public function testItFailsIfFilterIsNotADateFilter()
    {
        $this->shouldFail();

        $mock = new MockFilter(new FakeBooleanFilter);

        $mock->assertDateFilter();
    }

    // endregion

    // region assertHasOption
    public function testItSucceedsIfOptionContainsKey()
    {
        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertHasOption('Alpha Choice');
    }

    public function testItSucceedsIfOptionContainsValue()
    {
        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertHasOption('alpha');
    }

    public function testItFailsIfOptionContainsNeitherKeyNorValue()
    {
        $this->shouldFail();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertHasOption('not there');
    }

    // endregion

    // region assertOptionMissing
    public function testItSucceedsIfOptionMissingKeyAndValue()
    {
        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertOptionMissing('not there');
    }

    public function testItFailsIfOptionContainsKey()
    {
        $this->shouldFail();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertOptionMissing('Alpha Choice');
    }

    public function testItFailsIfOptionContainsValue()
    {
        $this->shouldFail();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->assertOptionMissing('alpha');
    }

    // endregion

    // region apply
    public function testItReturnsAMockQuery()
    {
        $this->usesDatabase();

        $mock = new MockFilter(new FakeSelectFilter);

        $mockQuery = $mock->apply(MockModel::class, 'alpha');

        $this->assertInstanceOf(MockFilterQuery::class, $mockQuery);
    }

    public function testItThrowsErrorWhenInvalidModelProvided()
    {
        $this->usesDatabase()->expectException(InvalidModelException::class);

        (new MockFilter(new FakeSelectFilter))->apply('not model', 'value');
    }
}
