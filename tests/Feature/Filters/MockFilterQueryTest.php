<?php

namespace FriendsOfCat\NovaUnit\Tests\Feature\Filters;

use FriendsOfCat\NovaUnit\Filters\MockFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\Filters\FakeSelectFilter;
use FriendsOfCat\NovaUnit\Tests\Fixtures\MockModel;
use FriendsOfCat\NovaUnit\Tests\TestCase;

class MockFilterQueryTest extends TestCase
{
    public function testItSucceedsIfQueryReturnsMatchingModels()
    {
        $this->usesDatabase();

        $model = new MockModel(['text' => 'alpha']);
        $model->save();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->apply(MockModel::class, 'alpha')->assertContains($model);
    }

    public function testItFailsIfQueryDoesNotReturnMatchingModels()
    {
        $this->usesDatabase()->shouldFail();

        $model = new MockModel(['text' => 'alpha']);
        $model->save();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->apply(MockModel::class, 'beta')->assertContains($model);
    }

    public function testItSucceedsIfModelMissingFromQueryResult()
    {
        $this->usesDatabase();

        $model = new MockModel(['text' => 'alpha']);
        $model->save();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->apply(MockModel::class, 'beta')->assertMissing($model);
    }

    public function testItFailsIfModelNotMissingFromQueryResult()
    {
        $this->usesDatabase()->shouldFail();

        $model = new MockModel(['text' => 'alpha']);
        $model->save();

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->apply(MockModel::class, 'alpha')->assertMissing($model);
    }

    public function testItSuccessfullyCountsReturnedRecords()
    {
        $this->usesDatabase();

        for ($i = 0; $i < 3; $i++) {
            (new MockModel(['text' => 'alpha']))->save();
        }

        for ($i = 0; $i < 5; $i++) {
            (new MockModel(['text' => 'beta']))->save();
        }

        $mock = new MockFilter(new FakeSelectFilter);

        $mock->apply(MockModel::class, 'alpha')->assertCount(3);
    }
}
