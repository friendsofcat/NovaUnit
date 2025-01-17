<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Lenses;

use FriendsOfCat\NovaUnit\Exceptions\InvalidModelException;
use FriendsOfCat\NovaUnit\Lenses\MockLens;
use FriendsOfCat\NovaUnit\Lenses\MockLensQuery;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Lenses\LensQueryTenOrGreater;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Lenses\LensValidFieldsAndActions;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Lenses\LensWithFiltersAndOrdering;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Lenses\LensWithoutFiltersAndOrdering;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use FriendsOfCat\NovaUnit\Tests\TestCase;

class MockLensTest extends TestCase
{
    public function testItSucceedsIfQueryReturnsMatchingModels()
    {
        $this->usesDatabase();

        $model = new MockModel(['number' => 10]);
        $model->save();

        $mockLens = new MockLens(LensQueryTenOrGreater::class, MockModel::class);

        $mockLens->assertQueryContains($model);
    }

    public function testItFailsIfQueryDoesNotReturnMatchingModels()
    {
        $this->usesDatabase()->shouldFail();

        $model = new MockModel(['number' => 9]);
        $model->save();

        $mockLens = new MockLens(LensQueryTenOrGreater::class, MockModel::class);

        $mockLens->assertQueryContains($model);
    }

    public function testItSucceedsIfModelMissingFromQueryResult()
    {
        $this->usesDatabase();

        $model = new MockModel(['number' => 9]);
        $model->save();

        $mockLens = new MockLens(LensQueryTenOrGreater::class, MockModel::class);

        $mockLens->assertQueryMissing($model);
    }

    public function testItFailsIfModelNotMissingFromQueryResult()
    {
        $this->usesDatabase()->shouldFail();

        $model = new MockModel(['number' => 10]);
        $model->save();

        $mockLens = new MockLens(LensQueryTenOrGreater::class, MockModel::class);

        $mockLens->assertQueryMissing($model);
    }

    public function testItSucceedsIfQueryCalledWithFilters()
    {
        $mockLens = new MockLens(LensWithFiltersAndOrdering::class, MockModel::class);

        $mockLens->assertQueryWithFilters();
    }

    public function testItFailsIfQueryNotCalledWithFilters()
    {
        $this->shouldFail();

        $mockLens = new MockLens(LensWithoutFiltersAndOrdering::class, MockModel::class);

        $mockLens->assertQueryWithFilters();
    }

    public function testItSucceedsIfQueryCalledWithOrdering()
    {
        $mockLens = new MockLens(LensWithFiltersAndOrdering::class, MockModel::class);

        $mockLens->assertQueryWithOrdering();
    }

    public function testItFailsIfQueryNotCalledWithOrdering()
    {
        $this->shouldFail();

        $mockLens = new MockLens(LensWithoutFiltersAndOrdering::class, MockModel::class);

        $mockLens->assertQueryWithOrdering();
    }

    public function testItReturnsAMockQuery()
    {
        $this->usesDatabase();

        $mockLens = new MockLens(LensValidFieldsAndActions::class, MockModel::class);

        $mockQuery = $mockLens->query();

        $this->assertInstanceOf(MockLensQuery::class, $mockQuery);
    }

    public function testItReturnsAMockQueryWithModelClassIncludedInQuery()
    {
        $this->usesDatabase();

        $mockLens = new MockLens(LensValidFieldsAndActions::class);

        $mockQuery = $mockLens->query(MockModel::class);

        $this->assertInstanceOf(MockLensQuery::class, $mockQuery);
    }

    public function testItThrowsErrorWhenModelClassNotIncludedInConstructorOrQuery()
    {
        $this->usesDatabase()->expectException(InvalidModelException::class);

        (new MockLens(LensValidFieldsAndActions::class))->query();
    }
}
